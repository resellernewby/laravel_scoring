<?php

namespace App\Http\Livewire\NonConsumable\Item;

use App\Models\Asset;
use App\Models\NonConsumable;
use App\Models\Order;
use App\Services\Setting;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class Table extends ModalComponent
{
    use WithPagination;

    public $asset;
    public $search = '';
    public $isDelete = false;
    public $filters = [
        'status' => '',
        'condition' => ''
    ];

    protected $listeners = [
        'itemTable' => '$refresh'
    ];

    public function mount(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function getRowsQueryProperty()
    {
        return NonConsumable::query()
            ->with([
                'asset' => [
                    'brand',
                    'imageFirst'
                ]
            ])
            ->when($this->search, fn ($query) => $query->search($this->search))
            ->when($this->filters['status'], fn ($query) => $query->where(
                'current_status',
                $this->filters['status']
            ))
            ->when($this->filters['condition'], fn ($query) => $query->where(
                'condition',
                $this->filters['condition']
            ))
            ->where('asset_id', $this->asset->id)
            ->whereNotIn('current_status', ['sold', 'destroyed'])
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.non-consumable.item.table', [
            'nonConsumables' => $this->rows,
            'lists' => $this->lists
        ]);
    }

    // public function addCart($id)
    // {
    //     $item = Asset::where('type', 'non-consumable')->find($id);
    //     if (!$item) {
    //         $this->notify('Data tidak ditemukan');
    //         return;
    //     }

    //     if ($item->cart()->where('user_id', auth()->id())->count() > 0) {
    //         $item->cart()->increment('qty');
    //     } else {
    //         $item->cart()->create([
    //             'user_id' => auth()->id(),
    //             'qty' => 1
    //         ]);
    //     }

    //     $this->emit('addToCart');
    // }

    public function destroy(NonConsumable $nonConsumable)
    {
        $this->isDelete = false;
        if ($nonConsumable->current_status != 'in_stock') {
            $this->notify('Barang dengan serial <strong>' . $nonConsumable->serial . '</strong> status sudah berubah, tidak bisa dihapus!', 'warning');
            return;
        }

        DB::transaction(function () use ($nonConsumable) {
            DB::table('asset_rack')->where('asset_id', $nonConsumable->asset_id)
                ->where('rack_id', $nonConsumable->nonConsumable->id)
                ->decrement('qty');

            // Riwayat pengurangan
            $order = Order::create([
                'name' => auth()->user()->name,
                'status' => 'delete stock',
                'date' => now(),
                'location' => $nonConsumable->nonConsumable->name
            ]);

            // Create Transaction pengurangan stock
            $order->transactions()->create([
                'asset_id' => $nonConsumable->asset_id,
                'qty' => 1,
                'price' => $nonConsumable->price
            ]);

            $nonConsumable->delete();
        });

        $this->emit('nonConsumableTable');
        $this->notify($nonConsumable->asset->name . ' dengan serial <strong>' . $nonConsumable->serial . '</strong> berhasil dihapus');
    }

    public function getListsProperty()
    {
        $status = Setting::get('status') ?? [];
        $conditions = Setting::get('conditions') ?? [];
        if (empty($status)) {
            return config('setting.status');
        }

        if (empty($conditions)) {
            return config('setting.conditions');
        }

        $status = json_decode($status, true);
        $conditions = json_decode($conditions, true);

        return [
            'status' => $status,
            'conditions' => $conditions
        ];
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
