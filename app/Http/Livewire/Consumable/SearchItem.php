<?php

namespace App\Http\Livewire\Consumable;

use App\Http\Livewire\History\Asset;
use Livewire\Component;

class SearchItem extends Component
{
    public $limit = 10;
    public $totalRecords;

    public function loadMore()
    {
        $this->limit += 10;
    }

    public function mount()
    {
        $this->totalRecords = Asset::query()
            ->where('type', 'consumable')
            ->count();
    }

    public function render()
    {
        return view('livewire.consumable.search-item', [
            'items' => Asset::query()
                ->where('type', 'consumable')
                ->limit($this->limit)
                ->get()
        ]);
    }
}
