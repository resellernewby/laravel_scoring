<?php

namespace App\Http\Livewire\NonConsumable\Item;

use App\Models\Location;
use App\Models\NonConsumable;
use App\Models\Order;
use App\Models\Rack;
use App\Traits\LocationList;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class Checkout extends ModalComponent
{
    use LocationList;

    public $nonConsumable;
    public $location_id;
    public $user;

    protected $listeners = [
        'locationCreated' => '$refresh'
    ];

    protected $rules = [
        'user' => 'required|max:150',
        'location_id' => 'required'
    ];

    protected $messages = [
        'user.required' => 'Nama pengguna harus diisi!',
        'user.max' => 'Nama pengguna maksimal 150 karakter'
    ];

    public function mount(NonConsumable $nonConsumable)
    {
        $this->nonConsumable = $nonConsumable;
    }

    public function render()
    {
        return view('livewire.non-consumable.item.checkout', [
            'locationLists' => $this->locationLists
        ]);
    }

    public function update()
    {
        $this->validate();

        DB::transaction(function () {
            DB::table('asset_rack')->where('asset_id', $this->nonConsumable->asset_id)
                ->where('rack_id', $this->nonConsumable->nonConsumable->id)
                ->decrement('qty');

            $this->nonConsumable->update([
                'non_consumable_id' => $this->location_id,
                'non_consumable_type' => Location::class,
                'user' => $this->user,
                'current_status' => 'in_use',
                'used_at' => now()
            ]);

            $this->nonConsumable->nonConsumableTransactions()->create([
                'nct_able_id' => $this->location_id,
                'nct_able_type' => Location::class,
                'action' => 'checkout',
                'user' => $this->user,
                'condition' => 'excellent'
            ]);

            $this->nonConsumable->asset->decrement('qty');

            // Riwayat action
            $order = Order::create([
                'name' => $this->user,
                'status' => 'in_use',
                'date' => now(),
                'location' => Location::find($this->location_id)?->name,
            ]);

            // Create Transaction
            $order->transactions()->create([
                'asset_id' => $this->nonConsumable->asset_id,
                'qty' => 1,
                'price' => $this->nonConsumable->price
            ]);
        });

        $this->emit('itemTable');
        $this->closeModal();
        $this->notify('Checkout berhasil, barang digunakan oleh ' . $this->user);
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
