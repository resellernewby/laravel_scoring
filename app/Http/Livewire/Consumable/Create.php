<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Brand;
use App\Models\Consumable;
use App\Models\Rack;
use App\Models\Suplier;
use App\Models\Tag;
use App\Models\Warehouse;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public Collection $storages;
    public $images = [];
    public $tags = [];
    public $inputs = [];
    public $qty;
    public $lifetime;
    public $warehouse_ids;
    public $rack_id;

    protected $listeners = [
        'consumableCreate' => 'refreshBrand'
    ];

    public function mount()
    {
        $this->storages = collect([
            [
                'warehouse_id' => '',
                'rack_id' => '',
                'qty' => ''
            ]
        ]);
    }

    public function addInput()
    {
        $this->storages->push([
            'warehouse_id' => '',
            'rack_id' => '',
            'qty' => ''
        ]);
    }

    public function removeInput($key)
    {
        $this->storages->pull($key);
    }

    public function render()
    {
        return view('livewire.consumable.create', [
            'tagLists' => $this->tagLists,
            'brandLists' => $this->brandLists,
            'suplierLists' => $this->suplierLists,
            'warehouseLists' => $this->warehouseLists,
            'rackLists' => $this->rackLists
        ]);
    }

    public function store()
    {
        $this->emit('consumableTable');
        $this->closeModal();
        $this->notify('Barang baru berhasil ditambahkan');
    }

    public function getTagListsProperty()
    {
        return Tag::pluck('name', 'id');
    }

    public function getBrandListsProperty()
    {
        return Brand::pluck('name', 'id');
    }

    public function getSuplierListsProperty()
    {
        return Suplier::pluck('name', 'id');
    }

    public function getWarehouseListsProperty()
    {
        return Warehouse::pluck('name', 'id');
    }

    public function getRackListsProperty()
    {
        // dd($this->warehouse_ids);
        if (!$this->warehouse_ids) {
            return;
        }

        $data = [];
        foreach ($this->warehouse_ids as $key => $value) {
            $data[$key] = Rack::where('warehouse_id', $value)->pluck('name', 'id');
        }

        return $data;
    }
}
