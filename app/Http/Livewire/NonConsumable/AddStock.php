<?php

namespace App\Http\Livewire\NonConsumable;

use App\Actions\NonConsumables\AddStockNonConsumable;
use App\Http\Requests\NonConsumableAddStockRequest;
use App\Models\Asset;
use App\Traits\FundsList;
use App\Traits\RackList;
use App\Traits\SuplierList;
use App\Traits\WarehouseList;
use Illuminate\Support\Collection;
use Livewire\Component;

class AddStock extends Component
{
    use SuplierList, FundsList, WarehouseList, RackList;

    public Collection $storages;
    public Asset $asset;
    public $rack = [];
    public $nonconsumable = [];

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
        return view('livewire.non-consumable.add-stock', [
            'suplierLists' => $this->suplierLists,
            'fundsLists' => $this->fundsLists,
            'warehouseLists' => $this->warehouseLists,
            'rackLists' => $this->rackLists
        ]);
    }

    public function store(AddStockNonConsumable $addStock)
    {
        // Validate data
        $validatedData = $this->validate();
        $validatedData['asset_id'] = $this->asset->id;
        $validatedData['asset']['purchase_at'] = $validatedData['nonconsumable']['purchase_date'];
        $validatedData['nonconsumable']['price'] = $validatedData['asset']['current_price'];

        // Add Stock
        $nonConsumables = $addStock->handle($validatedData);

        $this->emit('openModal', 'non-consumable.update-serial', ['nonConsumables' => $nonConsumables]);
    }

    public function rules()
    {
        return (new NonConsumableAddStockRequest())->rules();
    }

    public function messages()
    {
        return (new NonConsumableAddStockRequest())->messages();
    }
}
