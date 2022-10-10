<?php

namespace App\Http\Livewire\Rack;

use App\Models\Warehouse;
use Livewire\Component;

class Racks extends Component
{
    public $isDelete;

    public function mount(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse->load('racks');
    }

    public function render()
    {
        return view('livewire.rack.racks');
    }
}
