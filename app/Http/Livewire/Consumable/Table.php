<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\Cart;
use Livewire\Component;
use App\Models\Consumable;
use App\Models\Tag;
use App\Models\Warehouse;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete = false;
    public $filters = [
        'tag' => '',
        'brand' => '',
        'warehouse' => ''
    ];

    protected $listeners = [
        'consumableTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Asset::query()
            ->with([
                'consumable',
                'brand',
                'racks.warehouse',
                'tags',
                'imageFirst'
            ])
            ->when($this->search, fn ($query) => $query->search($this->search))
            ->when($this->filters['tag'], fn ($query) => $query->whereHas(
                'tags',
                fn ($q) => $q->where('id', $this->filters['tag'])
            ))
            ->when($this->filters['brand'], fn ($query) => $query->where('brand_id', $this->filters['brand']))
            ->when($this->filters['warehouse'], fn ($query) => $query->whereHas(
                'warehouses',
                fn ($q) => $q->where('id', $this->filters['warehouse'])
            ))
            ->where('type', 'consumable')
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.consumable.table', [
            'consumables' => $this->rows,
            'lists' => $this->lists
        ]);
    }

    public function addCart($id)
    {
        $item = Asset::find($id);
        if ($item->cart()->where('user_id', auth()->id())->count() > 0) {
            $item->cart()->increment('qty');
        } else {
            $item->cart()->create([
                'user_id' => auth()->id(),
                'qty' => 1
            ]);
        }

        $this->emit('addToCart');
    }

    public function destroy(Consumable $consumable)
    {
        $this->isDelete = false;

        if ($consumable->consumableTransactions()->count() > 0) {
            $this->notify($consumable->name . ' tidak bisa dihapus!', 'error');
            return;
        }

        $consumable->delete();
        $this->notify($consumable->name . ' berhasil dihapus');
    }

    public function getListsProperty()
    {
        return [
            'tags' => Tag::pluck('name', 'id'),
            'brands' => Brand::pluck('name', 'id'),
            'warehouses' => Warehouse::pluck('name', 'id'),
        ];
    }
}
