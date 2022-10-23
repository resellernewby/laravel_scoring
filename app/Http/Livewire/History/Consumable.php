<?php

namespace App\Http\Livewire\History;

use App\Models\ConsumableTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class Consumable extends Component
{
    use WithPagination;

    public $search = '';

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
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }
}
