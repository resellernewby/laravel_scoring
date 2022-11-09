<?php

namespace App\Http\Livewire\Asset;

use Livewire\Component;
use App\Models\Asset;
use App\Models\Brand;
use App\Models\StatusAsset;
use App\Models\Tag;
use App\Models\Warehouse;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $tagLists;
    public $brandLists;
    public $warehouseLists;
    public $statusLists;
    public $search = '';
    public $isDelete = false;
    public $filters = [
        'tag' => '',
        'brand' => '',
        'warehouse' => '',
        'status' => ''
    ];

    protected $listeners = [
        'assetTable' => '$refresh'
    ];

    public function mount()
    {
        $this->tagLists = Tag::pluck('name', 'id');
        $this->brandLists = Brand::pluck('name', 'id');
        $this->warehouseLists = Warehouse::pluck('name', 'id');
        $this->statusLists = StatusAsset::pluck('name', 'id');
    }

    public function getRowsQueryProperty()
    {
        return Asset::query()
            ->with(['brand', 'statusAsset', 'tags', 'subracks'])
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->filters['tag'], fn ($query) => $query->whereHas(
                'tags',
                fn ($q) => $q->where('id', $this->filters['tag'])
            ))
            ->when($this->filters['brand'], fn ($query) => $query->where('brand_id', $this->filters['brand']))
            ->when($this->filters['warehouse'], fn ($query) => $query->whereHas(
                'subracks',
                fn ($q) => $q->whereHas(
                    'rack',
                    fn ($q) => $q->whereHas(
                        'warehouse',
                        fn ($q) => $q->where('id', $this->filters['warehouse'])
                    )
                )
            ))
            ->when($this->filters['status'], fn ($query) => $query->where('status_asset_id', $this->filters['status']))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.asset.table', [
            'assets' => $this->rows
        ]);
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        $this->isDelete = false;

        $this->notify('Asset berhasil dihapus');
    }
}
