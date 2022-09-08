<?php

namespace App\Http\Livewire\Consumable;

use Livewire\Component;
use App\Models\Consumable;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete = false;

    protected $listeners = [
        'consumableTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Consumable::query()
            ->with(['brand', 'subracks', 'addConsumables'])
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function render()
    {
        return view('livewire.consumable.table', [
            'consumables' => $this->rows
        ]);
    }

    public function destroy(Consumable $consumable)
    {
        $this->isDelete = false;

        if ($consumable->addConsumables()->count() > 0) {
            $this->notify($consumable->name . ' tidak bisa dihapus!', 'error');
            return;
        }

        $consumable->delete();
        $this->notify($consumable->name . ' berhasil dihapus');
    }
}
