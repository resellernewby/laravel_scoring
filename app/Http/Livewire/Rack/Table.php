<?php

namespace App\Http\Livewire\Rack;

use App\Models\Rack;
use App\Models\Subrack;
use App\Models\Warehouse;
use Livewire\Component;

class Table extends Component
{
    public $isDelete;

    protected $listeners = [
        'rackTable' => '$refresh'
    ];

    public function mount(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse->load('racks.subracks');
    }

    public function render()
    {
        return view('livewire.rack.table');
    }

    public function destroy(Rack $rack)
    {
        $this->isDelete = false;

        if ($rack->subracks()->count() > 0) {
            $this->notify($rack->name . ' tidak bisa dihapus!', 'warning');
            return;
        }

        $rack->delete();
        $this->notify($rack->name . ' berhasil dihapus');
        $this->emitSelf('rackTable');
    }

    public function deleteSubrack(Subrack $subrack)
    {
        if ($subrack->assets()->count() > 0 || $subrack->consumables()->count() > 0) {
            $this->notify($subrack->name . ' tidak bisa dihapus!', 'warning');
            return;
        }

        $subrack->delete();
        $this->notify($subrack->name . ' berhasil dihapus');
        $this->emitSelf('rackTable');
    }
}
