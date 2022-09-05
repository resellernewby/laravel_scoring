<?php

namespace App\Http\Livewire\Consumable;

use Livewire\Component;
use App\Models\Consumable;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = [
        'consumableTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Consumable::query()
            ->with(['brand', 'subracks'])
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

    public function showBillingDetail($userDetailID)
    {
        $this->emit('openModal', 'dash.billing.detail', ['userDetail' => $userDetailID]);
    }

    public function showEditSaldo($userDetailID)
    {
        $this->emit('openModal', 'dash.balance.edit', ['userDetail' => $userDetailID]);
    }
}
