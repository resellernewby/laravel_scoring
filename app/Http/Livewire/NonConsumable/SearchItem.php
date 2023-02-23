<?php

namespace App\Http\Livewire\NonConsumable;

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
            ->where('type', 'non-consumable')
            ->count();
    }

    public function render()
    {
        return view('livewire.non-consumable.search-item', [
            'assets' => $this->nonConsumables
        ]);
    }

    public function getNonConsumablesProperty()
    {
        $assets = [];
        if ($this->search) {
            $assets = Asset::query()
                ->search($this->search)
                ->where('type', 'non-consumable')
                ->limit($this->limit)
                ->get();
        }

        return $assets;
    }
}
