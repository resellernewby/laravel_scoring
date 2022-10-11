<?php

namespace App\Http\Livewire\Asset;

use Livewire\Component;
use App\Models\Asset;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete = false;

    protected $listeners = [
        'assetTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Asset::query()
            ->with(['brand', 'statusAsset', 'tags', 'subracks'])
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.asset.table', [
            'assets' => $this->rows
        ]);
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        $this->isDelete = false;

        $this->notify('Asset berhasil dihapus');
    }
}
