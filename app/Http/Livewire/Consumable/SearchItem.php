<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Asset;
use Livewire\Component;

class SearchItem extends Component
{
    public $limit = 10;
    public $info = true;
    public $totalRecords;
    public $search;

    protected $listeners = [
        'loadMore'
    ];

    public function loadMore()
    {
        $this->limit += 10;
    }

    public function selected($consumableID)
    {
        $this->search = null;
        $this->info = false;
        $this->emit('selectedItem', $consumableID);
    }

    public function mount()
    {
        $this->totalRecords = Asset::query()
            ->search($this->search)
            ->where('type', 'consumable')
            ->count();
    }

    public function render()
    {
        return view('livewire.consumable.search-item', [
            'consumables' => $this->consumables
        ]);
    }

    public function getConsumablesProperty()
    {
        $consumables = [];
        if ($this->search) {
            $consumables = Asset::query()
                ->search($this->search)
                ->where('type', 'consumable')
                ->limit($this->limit)
                ->get();
        }

        return $consumables;
    }
}
