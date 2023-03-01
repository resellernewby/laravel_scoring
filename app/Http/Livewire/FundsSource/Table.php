<?php

namespace App\Http\Livewire\FundsSource;

use App\Models\FundsSource;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete;

    protected $listeners = [
        'fundsTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return FundsSource::query()
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.funds-source.table', [
            'fundsSources' => $this->rows
        ]);
    }

    public function destroy(FundsSource $funds)
    {
        $this->isDelete = false;

        if ($funds->assets()->count() > 0) {
            $this->notify($funds->name . ' tidak bisa dihapus!', 'warning');
            return;
        }

        $funds->delete();
        $this->notify($funds->name . ' berhasil dihapus');
    }
}
