<?php

namespace App\Http\Livewire\Asset;

use App\Models\Asset;
use Livewire\Component;

class Stat extends Component
{
    public $used;
    public $unused;
    public $broken;

    public function mount()
    {
        $this->used = Asset::whereHas('statusAsset', fn ($q) => $q->whereIn('id', [2, 4]))->count();
        $this->unused = Asset::whereHas('statusAsset', fn ($q) => $q->where('id', 1))->count();
        $this->broken = Asset::whereHas('statusAsset', fn ($q) => $q->whereIn('id', [3, 5]))->count();
    }

    public function render()
    {
        return view('livewire.asset.stat');
    }
}
