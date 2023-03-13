<?php

namespace App\Http\Livewire\DamagedAsset;

use App\Models\NonConsumable;
use App\Traits\BrandList;
use App\Traits\TagList;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, BrandList, TagList;

    public $search = '';
    public $isDelete = false;
    public $filters = [
        'tag' => '',
        'brand' => '',
    ];

    protected $listeners = [
        'damagedAssetTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return NonConsumable::query()
            ->with([
                'asset' => [
                    'brand',
                    'imageFirst',
                    'tags'
                ],
            ])
            ->when($this->search, fn ($query) => $query->search($this->search))
            ->when($this->filters['tag'], fn ($query) => $query->whereHas(
                'tags',
                fn ($q) => $q->where('id', $this->filters['tag'])
            ))
            ->when($this->filters['brand'], fn ($query) => $query->where('brand_id', $this->filters['brand']))
            ->whereIn('current_status', ['damaged', 'in_repair', 'sold', 'destroyed'])
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.damaged-asset.table', [
            'nonConsumables' => $this->rows,
            'brandLists' => $this->brandLists,
            'tagLists' => $this->tagLists
        ]);
    }
}
