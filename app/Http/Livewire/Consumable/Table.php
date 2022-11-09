<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Consumable;
use App\Models\Tag;
use App\Models\Warehouse;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $tagLists;
    public $brandLists;
    public $warehouseLists;
    public $search = '';
    public $isDelete = false;
    public $filters = [
        'tag' => '',
        'brand' => '',
        'warehouse' => '',
        'status' => ''
    ];

    protected $listeners = [
        'consumableTable' => '$refresh'
    ];

    public function mount()
    {
        $this->tagLists = Tag::pluck('name', 'id');
        $this->brandLists = Brand::pluck('name', 'id');
        $this->warehouseLists = Warehouse::pluck('name', 'id');
    }

    public function getRowsQueryProperty()
    {
        return Consumable::query()
            ->with(['brand', 'subracks', 'consumableTransactions'])
            ->withSum('consumableTransactions', 'qty')
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->filters['tag'], fn ($query) => $query->whereHas(
                'tags',
                fn ($q) => $q->where('id', $this->filters['tag'])
            ))
            ->when($this->filters['brand'], fn ($query) => $query->where('brand_id', $this->filters['brand']))
            ->when($this->filters['warehouse'], fn ($query) => $query->whereHas(
                'subracks',
                fn ($q) => $q->whereHas(
                    'rack',
                    fn ($q) => $q->whereHas(
                        'warehouse',
                        fn ($q) => $q->where('id', $this->filters['warehouse'])
                    )
                )
            ))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
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

        if ($consumable->consumableTransactions()->count() > 0) {
            $this->notify($consumable->name . ' tidak bisa dihapus!', 'error');
            return;
        }

        $consumable->delete();
        $this->notify($consumable->name . ' berhasil dihapus');
    }
}
