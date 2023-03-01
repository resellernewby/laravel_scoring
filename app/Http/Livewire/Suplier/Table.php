<?php

namespace App\Http\Livewire\Suplier;

use App\Models\Suplier;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete;

    protected $listeners = [
        'suplierTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Suplier::query()
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.suplier.table', [
            'supliers' => $this->rows
        ]);
    }

    public function destroy(Suplier $suplier)
    {
        $this->isDelete = false;

        if ($suplier->assets()->count() > 0) {
            $this->notify($suplier->name . ' tidak bisa dihapus!', 'warning');
            return;
        }

        $suplier->delete();
        $this->notify($suplier->name . ' berhasil dihapus');
    }
}
