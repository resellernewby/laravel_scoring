<?php

namespace App\Http\Livewire\Consumable;

use App\Actions\Consumables\AddStockConsumable;
use App\Http\Requests\AddStockRequest;
use App\Models\Asset;
use App\Models\FundsSource;
use App\Models\Rack;
use App\Models\Suplier;
use App\Models\Warehouse;
use Illuminate\Support\Collection;
use Livewire\Component;

class AddStock extends Component
{
    public Collection $storages;
    public Asset $asset;
    public $rack = [];
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

    public function setID($assetID)
    {
        $this->asset = Asset::find($assetID);
    }

    public function render()
    {
        return view('livewire.consumable.add-stock', [
            'suplierLists' => $this->suplierLists,
            'fundsLists' => $this->fundsLists,
            'warehouseLists' => $this->warehouseLists,
            'rackLists' => $this->rackLists
        ]);
    }

    public function store(AddStockConsumable $addStock)
    {
        // Validate data
        $validatedData = $this->validate();
        $validatedData['asset_id'] = $this->asset->id;
        $validatedData['asset']['purchase_at'] = $this->purchase_at;

        // Add Stock
        $addStock->handle($validatedData);

        $this->emit('consumableTable');
        $this->notify('Stok barang berhasil ditambahkan');

        return redirect()->route('consumable.index');
    }

    public function rules()
    {
        return (new AddStockRequest())->rules();
    }

    public function messages()
    {
        return (new AddStockRequest())->messages();
    }

    public function getSuplierListsProperty()
    {
        return Suplier::oldest('name')->pluck('name', 'id');
    }

    public function getFundsListsProperty()
    {
        return FundsSource::oldest('name')->pluck('name', 'id');
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
