<?php

namespace App\Http\Livewire\Warehouse;

use Livewire\Component;
use App\Models\Warehouse;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete;

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
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.warehouse.table', [
            'warehouses' => $this->rows
        ]);
    }

    public function destroy(Warehouse $warehouse)
    {
        $this->isDelete = false;

        if ($warehouse->racks()->count() > 0) {
            $this->notify($warehouse->name . ' tidak bisa dihapus!', 'warning');
            return;
        }

        $warehouse->delete();
        $this->notify($warehouse->name . ' berhasil dihapus');
    }
}
