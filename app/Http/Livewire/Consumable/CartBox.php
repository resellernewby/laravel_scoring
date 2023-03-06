<?php

namespace App\Http\Livewire\Consumable;

use App\Actions\Consumables\CheckoutCartItem;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Location;
use Illuminate\Support\Collection;
use Livewire\Component;

class CartBox extends Component
{
    public Collection $qts;
    public $item = [];
    public $taken_by;
    public $location_id;

    protected $listeners = [
        'addToCart' => '$refresh',
        'locationCreated' => '$refresh'
    ];

    public function mount()
    {
        $this->qts = collect(
            $this->carts
        );
    }

    public function updated($propertyName)
    {
        $validated = $this->validateOnly($propertyName, [
            'qts.*.qty' => 'required'
        ]);

        foreach ($validated['qts'] as $key => $item) {
            $ready = $this->carts[$key]->asset->qty;
            if ($item['qty'] >= $ready) {
                $this->notify('Stok ' . $this->carts[$key]->asset->name . ' terbatas', 'warning');
            } else {
                $this->carts[$key]->update([
                    'qty' => $item['qty']
                ]);
            }
        }
    }

    public function increment(Cart $cart)
    {
        $ready = $cart->asset->qty;
        if ($cart->qty >= $ready) {
            $this->notify('Stok ' . $cart->asset->name . ' terbatas', 'warning');
            return;
        }

        $cart->increment('qty');
        $this->qts = collect(
            $this->carts
        );
    }

    public function decrement(Cart $cart)
    {
        if ($cart->qty <= 1) {
            return;
        }

        $cart->decrement('qty');
        $this->qts = collect(
            $this->carts
        );
    }

    public function remove(Cart $cart)
    {
        $cart->delete();
    }

    public function render()
    {
        return view('livewire.consumable.cart-box', [
            'carts' => $this->carts,
            'locationLists' => $this->locationLists
        ]);
    }

    public function checkout(CheckoutCartItem $cartItems)
    {
        if (count($this->item) < 1) {
            $this->notify('Rak tempat pengambilan belum dipilih', 'warning');
            return;
        }

        if (empty($this->carts)) {
            return;
        }

        foreach ($this->item as $key => $rack) {
            $error = true;
            $totalRackValue = 0;
            $taken = $this->carts[$key]->qty;
            $takenItemOnRacks = [];

            foreach ($rack as $rackId => $rackValue) {
                if (!$rackValue) {
                    continue;
                }

                $totalRackValue += $rackValue;
                $remaining = $totalRackValue - $taken;
                if ($totalRackValue > $taken) {
                    $error = false;
                }

                $takenItemOnRacks[] = [
                    'rack_id' => $rackId,
                    'remaining_qty' => ($remaining < 0 ? 0 : $remaining)
                ];
            }

            if ($error) {
                $this->notify("Rak pengambilan <strong>{$this->carts[$key]->asset->name}</strong> belum dipilih atau tidak mencukupi", 'warning');
                return;
            }

            $this->carts[$key]->taken_item_on_racks = $takenItemOnRacks;
        }

        $this->validate();

        $cartItems->handle($this->carts, $this->taken_by, $this->location_id);

        $this->emit('consumableTable');
        $this->notify('Chekout barang berhasil diproses');

        return redirect()->route('consumable.index');
    }

    public function rules()
    {
        return (new CheckoutRequest())->rules();
    }

    public function messages()
    {
        return (new CheckoutRequest())->messages();
    }

    public function getCartsProperty()
    {
        return Cart::with(['asset.racks.warehouse'])
            ->whereHas('asset', fn ($q) => $q->where('type', 'consumable'))
            ->where('user_id', auth()->id())
            ->get();
    }

    public function getLocationListsProperty()
    {
        return Location::oldest('name')->pluck('name', 'id');
    }
}
