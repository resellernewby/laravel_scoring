<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Consumable;
use Livewire\Component;

class Stat extends Component
{
    public $available;
    public $low;
    public $out;

    public function mount()
    {
        $this->available = Consumable::where('qty', '>', 0)->count();
        $this->low = Consumable::where('qty', '<', 2)->count();
        $this->out = Consumable::where('qty', '<', 1)->count();
    }

    public function render()
    {
        return view('livewire.consumable.stat');
    }
}
