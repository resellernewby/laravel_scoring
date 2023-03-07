<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Asset;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Tag;
use App\Models\Warehouse;
use App\Services\Setting;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete = false;
    public $showFilters = false;
    public $filters = [
        'tag' => '',
        'brand' => '',
        'warehouse' => '',
        'stock' => ''
    ];

    public $stockFilters = [
        'available' => 'Stok tersedia',
        'lowstock' => 'Stok segera habis',
        'outstock' => 'Stok habis',
    ];

    protected $listeners = [
        'consumableTable' => '$refresh',
        'taggedToAsset' => '$refresh',
        'setStock'
    ];

    public function getRowsQueryProperty()
    {
        return Asset::query()
            ->with([
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
            ->when($this->filters['stock'], function ($query) {
                $query->when($this->filters['stock'] == 'available', fn ($q) => $q->where('qty', '>', 0))
                    ->when($this->filters['stock'] == 'lowstock', fn ($q) => $q->where('qty', '<', (int) Setting::get('lowstock')))
                    ->when($this->filters['stock'] == 'outstock', fn ($q) => $q->where('qty', '<', 1));
            })
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

    public function setStock($stock)
    {
        $this->filters['stock'] = $stock;
    }

    public function resetStock()
    {
        $this->filters['stock'] = '';
    }

    public function addCart($id)
    {
        $item = Asset::where('type', 'consumable')->find($id);
        if (!$item) {
            $this->notify('Data tidak ditemukan');
            return;
        }

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

    public function destroy(Asset $asset)
    {
        $this->isDelete = false;

        if ($asset->consumable->consumableTransactions()->count() > 0) {
            $this->notify($asset->name . ' punya riwayat pemakaian, tidak bisa dihapus!', 'warning');
            return;
        }

        DB::transaction(function () use ($asset) {
            $asset->warehouses()->detach();
            $asset->racks()->detach();
            $asset->tags()->detach();
            $asset->consumable()->delete();
            $asset->transactions()->delete();
            $asset->assetImages()->delete();
            $asset->assetSpecifications()->delete();
            $asset->cart()->delete();
            $asset->delete();
        });

        $this->emit('addToCart');
        $this->notify($asset->name . ' berhasil dihapus');
    }

    public function addMoreTags($asset)
    {
        $this->emit('openModal', 'tag.tagged-asset', ['asset' => $asset]);
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
