<?php

namespace App\Http\Livewire\NonConsumable;

use App\Actions\Consumables\CreateConsumableItem;
use App\Http\Requests\ConsumableRequest;
use App\Models\Brand;
use App\Models\FundsSource;
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
    public Collection $specifications;
    public $images = [];
    public $asset = [];
    public $spec = [];
    public $rack = [];
    public $tag_ids;
    // public $tag_ids = [];
    public $funds_source_id;
    public $economic_age;

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

    public function getTagListsProperty()
    {
        return Tag::oldest('name')->pluck('name', 'id');
    }

    public function getBrandListsProperty()
    {
        return Brand::oldest('name')->pluck('name', 'id');
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