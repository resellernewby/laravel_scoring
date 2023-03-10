<?php

namespace App\Http\Livewire\Location;

use App\Models\Location;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete;

    protected $listeners = [
        'locationTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Location::query()
            ->withCount(['consumableTransactions', 'nonConsumables', 'nonConsumableTransactions'])
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.location.table', [
            'locations' => $this->rows
        ]);
    }

    public function destroy(Location $location)
    {
        $this->isDelete = false;
        $location->delete();

        $this->notify($location->name . ' berhasil dihapus');
    }
}
