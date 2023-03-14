<?php

namespace App\Http\Livewire\NonConsumable;

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
        'nonConsumableTable' => '$refresh',
        'taggedToAsset' => '$refresh',
        'itemTable' => '$refresh',
        'setStock'
    ];

    public function getRowsQueryProperty()
    {
        return Asset::query()
            ->with([
                'nonConsumables',
                'brand',
                'racks.warehouse',
                'tags',
                'imageFirst'
            ])
            ->withCount([
                'nonConsumables as available' => fn ($query) => $query->where('current_status', 'in_stock'),
                'nonConsumables as returned' => fn ($query) => $query->where('current_status', 'returned'),
                'nonConsumables as used' => fn ($query) => $query->where('current_status', 'in_use'),
                'nonConsumables as damaged' => fn ($query) => $query->where('current_status', 'damaged'),
                'nonConsumables as repair' => fn ($query) => $query->where('current_status', 'in_repair'),
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
            ->where('type', 'non-consumable')
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.non-consumable.table', [
            'assets' => $this->rows,
            'lists' => $this->lists
        ]);
    }

    public function destroy(Asset $asset)
    {
        $this->isDelete = false;
        $count = $asset->nonConsumables()
            ->where('current_status', 'in_use')->count();
        if ($count > 0) {
            $this->notify($asset->name . ' punya riwayat pemakaian, tidak bisa dihapus!', 'warning');
            return;
        }

        DB::transaction(function () use ($asset) {
            $asset->warehouses()->detach();
            $asset->racks()->detach();
            $asset->tags()->detach();
            $asset->nonConsumables()->delete();
            $asset->transactions()->delete();
            $asset->assetImages()->delete();
            $asset->assetSpecifications()->delete();
            $asset->delete();
        });

        $this->notify($asset->name . ' berhasil dihapus');
    }

    public function showItems($asset)
    {
        $this->emit('openModal', 'non-consumable.item.table', ['asset' => $asset]);
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

    public function setStock($stock)
    {
        $this->filters['stock'] = $stock;
    }

    public function resetStock()
    {
        $this->filters['stock'] = '';
    }
}
