<?php

namespace App\Http\Livewire\NonConsumable;

use App\Actions\NonConsumables\CreateNonConsumableItem;
use App\Http\Requests\NonConsumableRequest;
use App\Traits\BrandList;
use App\Traits\FundsList;
use App\Traits\RackList;
use App\Traits\SuplierList;
use App\Traits\TagList;
use App\Traits\WarehouseList;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads,
        WarehouseList,
        RackList,
        FundsList,
        SuplierList,
        TagList,
        BrandList;

    public Collection $storages;
    public Collection $specifications;
    public $images = [];
    public $asset = [];
    public $nonconsumable = [];
    public $spec = [];
    public $rack = [];
    public $tag_ids;
    // public $tag_ids = [];
    public $funds_source_id;

    protected $listeners = [
        'tagCreated' => '$refresh',
        'brandCreated' => '$refresh',
        'suplierCreated' => '$refresh',
        'fundsCreated' => '$refresh'
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

        $this->specifications = collect([
            [
                'name' => '',
                'value' => ''
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

    public function addSpecInput()
    {
        $this->specifications->push([
            'name' => '',
            'value' => ''
        ]);
    }

    public function removeSpecInput($key)
    {
        $this->specifications->pull($key);
    }

    public function render()
    {
        return view('livewire.non-consumable.create', [
            'tagLists' => $this->tagLists,
            'brandLists' => $this->brandLists,
            'suplierLists' => $this->suplierLists,
            'fundsLists' => $this->fundsLists,
            'warehouseLists' => $this->warehouseLists,
            'rackLists' => $this->rackLists
        ]);
    }

    public function store(CreateNonConsumableItem $nonconsumable)
    {
        // Validate data
        $validatedData = $this->validate();
        $validatedData['nonconsumable']['purchase_date'] = $validatedData['asset']['purchase_at'];
        $validatedData['nonconsumable']['price'] = $validatedData['asset']['current_price'];

        // Create Item
        $nonConsumables = $nonconsumable->handle($validatedData);

        $this->emit('openModal', 'non-consumable.update-serial', ['nonConsumables' => $nonConsumables]);
    }

    public function rules()
    {
        return (new NonConsumableRequest())->rules();
    }

    public function messages()
    {
        return (new NonConsumableRequest())->messages();
    }
}
