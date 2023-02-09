<?php

namespace App\Http\Livewire\Consumable;

use App\Http\Requests\AddStockRequest;
use App\Models\Asset;
use App\Models\Rack;
use App\Models\Warehouse;
use Illuminate\Support\Collection;
use Livewire\Component;

class AddStock extends Component
{
    public Collection $storages;
    public $consumableID;
    public $rack = [];
    public $price;
    public $purchase_at;

    protected $listeners = [
        'selectedItem' => 'setID'
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

    public function setID($consumableID)
    {
        $this->consumableID = $consumableID;
    }

    public function render()
    {
        return view('livewire.consumable.add-stock', [
            'consumable' => $this->consumable,
            'warehouseLists' => $this->warehouseLists,
            'rackLists' => $this->rackLists
        ]);
    }

    public function store()
    {
        $validatedData = $this->validate();

        $this->consumable->consumableTransactions()
            ->create($validatedData['inputs']);

        $this->emit('consumableTable');
        $this->closeModal();
        $this->notify('Jumlah barang berhasil ditambahkan');
    }

    public function rules()
    {
        return (new AddStockRequest())->rules();
    }

    public function messages()
    {
        return (new AddStockRequest())->messages();
    }

    public function getConsumableProperty()
    {
        return Asset::find($this->consumableID);
    }

    public function getWarehouseListsProperty()
    {
        return Warehouse::oldest('name')->pluck('name', 'id');
    }

    public function getRackListsProperty()
    {
        if (empty($this->rack)) {
            return;
        }

        $data = [];
        foreach ($this->rack as $key => $value) {
            $data[$key] = Rack::where('warehouse_id', $value['warehouse_id'])
                ->oldest('name')
                ->pluck('name', 'id');
        }

        return $data;
    }
}
