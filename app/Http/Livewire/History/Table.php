<?php

namespace App\Http\Livewire\History;

use App\Models\Location;
use App\Models\Transaction;
use App\Traits\BrandList;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, BrandList;

    public $search = '';
    public $filters = [
        'type' => '',
        'start_date' => '',
        'end_date' => '',
        'brand' => '',
        'location' => '',
        'status' => ''
    ];

    public $typeLists = [
        'consumable' => 'Consumable',
        'non-consumable' => 'Non-Consumable',
    ];

    public function render()
    {
        return view('livewire.history.table', [
            'transactions' => $this->rows,
            'brandLists' => $this->brandLists,
            'locationLists' => $this->locationLists,
            'actionLists' => config('setting.action_lists')
        ]);
    }

    public function getRowsQueryProperty()
    {
        return Transaction::query()
            ->with([
                'asset' => [
                    'brand',
                    'imageFirst'
                ],
                'order'
            ])
            ->when($this->search, fn ($query) => $query->whereHas(
                'asset',
                fn ($q) => $q->where('name', 'like', '%' . $this->search . '%')
            ))
            ->when($this->filters['type'], fn ($query) => $query->whereHas(
                'asset',
                fn ($q) => $q->where('type', $this->filters['type'])
            ))
            ->when($this->filters['start_date'], fn ($query) => $query->whereHas(
                'order',
                fn ($q) => $q->whereDate('date', '>=', $this->filters['start_date'])
            ))
            ->when($this->filters['end_date'], fn ($query) =>  $query->whereHas(
                'order',
                fn ($q) => $q->whereDate('date', '<=', $this->filters['end_date'])
            ))
            ->when($this->filters['brand'], fn ($query) => $query->whereHas(
                'asset',
                fn ($q) => $q->where('brand_id', $this->filters['brand'])
            ))
            ->when($this->filters['location'], fn ($query) => $query->whereHas(
                'order',
                fn ($q) => $q->where('location', $this->filters['location'])
            ))
            ->when($this->filters['status'], fn ($query) => $query->whereHas(
                'order',
                fn ($q) => $q->where('status', $this->filters['status'])
            ))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function getLocationListsProperty()
    {
        return Location::oldest('name')->pluck('name', 'name');
    }
}
