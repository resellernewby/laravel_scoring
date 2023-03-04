<?php

namespace App\Http\Livewire\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete;

    protected $listeners = [
        'brandTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Brand::query()
            ->with(['assets'])
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.brand.table', [
            'brands' => $this->rows
        ]);
    }

    public function destroy(Brand $brand)
    {
        $this->isDelete = false;

        if ($brand->assets()->count() > 0) {
            $this->notify($brand->name . ' tidak bisa dihapus!', 'warning');
            return;
        }

        $brand->delete();
        $this->notify($brand->name . ' berhasil dihapus');
    }
}
