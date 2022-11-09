<?php

namespace App\Http\Livewire\History;

use App\Models\Brand;
use App\Models\ConsumableTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class Consumable extends Component
{
    use WithPagination;

    public $brandLists;
    public $search = '';
    public $filters = [
        'status' => '',
        'start_date' => '',
        'end_date' => '',
        'brand' => ''
    ];

    public function mount()
    {
        $this->brandLists = Brand::pluck('name', 'id');
        $this->statusLists = [
            'in' => 'Masuk',
            'out' => 'Keluar'
        ];
    }

    public function render()
    {
        return view('livewire.history.consumable', [
            'consumables' => $this->rows
        ]);
    }

    public function getRowsQueryProperty()
    {
        return ConsumableTransaction::query()
            ->with(['consumable', 'location'])
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->filters['status'], fn ($query) => $query->where('type', $this->filters['status']))
            ->when($this->filters['start_date'], fn ($query) => $query->whereDate('created_at', '>=', $this->filters['start_date']))
            ->when($this->filters['end_date'], fn ($query) => $query->whereDate('created_at', '<=', $this->filters['end_date']))
            ->when($this->filters['brand'], fn ($query) => $query->whereHas(
                'consumable',
                fn ($q) => $q->where('brand_id', $this->filters['brand'])
            ))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }
}
