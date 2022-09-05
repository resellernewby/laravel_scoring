<?php

namespace App\Http\Livewire\Warehouse;

use Livewire\Component;
use App\Models\Warehouse;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = [
        'warehouseTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Warehouse::query()
            ->with('racks')
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function render()
    {
        return view('livewire.warehouse.table', [
            'warehouses' => $this->rows
        ]);
    }
}
