<?php

namespace App\Http\Livewire\Consumable;

use App\Actions\Consumables\CreateConsumableItem;
use App\Http\Requests\ConsumableRequest;
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
    public Collection $spec;
    public $images = [];
    public $asset = [];
    // public $spec = [];
    public $rack = [];
    public $tag_ids;
    // public $tag_ids = [];
    public $funds_source_id;
    public $lifetime;

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

        $this->spec = collect([
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
        $this->spec->push([
            'name' => '',
            'value' => ''
        ]);
    }

    public function removeSpecInput($key)
    {
        $this->spec->pull($key);
    }

    public function render()
    {
        return view('livewire.consumable.create', [
            'tagLists' => $this->tagLists,
            'brandLists' => $this->brandLists,
            'suplierLists' => $this->suplierLists,
            'fundsLists' => $this->fundsLists,
            'warehouseLists' => $this->warehouseLists,
            'rackLists' => $this->rackLists
        ]);
    }

    public function store(CreateConsumableItem $consumable)
    {
        // Validate data
        $validatedData = $this->validate();

        // Create Item
        $consumable->handle($validatedData);

        $this->emit('consumableTable');
        $this->notify('Barang baru berhasil ditambahkan');

        return redirect()->route('consumable.index');
    }

    public function rules()
    {
        return (new ConsumableRequest())->rules();
    }

    public function messages()
    {
        return (new ConsumableRequest())->messages();
    }
}
