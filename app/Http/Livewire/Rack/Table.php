<?php

namespace App\Http\Livewire\Rack;

use App\Models\Rack;
use App\Models\Warehouse;
use Livewire\Component;

class Table extends Component
{
    public $isDelete;
    public int $warehouseId;

    protected $listeners = [
        'rackTable' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.rack.table', [
            'warehouse' => $this->warehouse,
        ]);
    }

    public function getWarehouseProperty()
    {
        return Warehouse::with(['racks'])->find($this->warehouseId);
    }

    public function destroy(Rack $rack)
    {
        $this->isDelete = false;

        if ($rack->assets()->count() > 0) {
            $this->notify($rack->name . ' tidak bisa dihapus!', 'warning');
            return;
        }

        $rack->delete();
        $this->notify($rack->name . ' berhasil dihapus');
    }
}
