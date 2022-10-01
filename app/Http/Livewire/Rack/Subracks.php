<?php

namespace App\Http\Livewire\Rack;

use App\Models\Rack;
use Livewire\Component;

class Subracks extends Component
{
    public function mount(Rack $rack)
    {
        $this->rack = $rack->load('subracks');
    }

    public function render()
    {
        return view('livewire.rack.subracks');
    }
}
