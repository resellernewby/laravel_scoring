<?php

namespace App\Http\Livewire\Consumable;

use App\Actions\Consumables\UpdateConsumableItem;
use App\Http\Requests\ConsumableRequest;
use App\Models\Asset;
use App\Models\Brand;
use App\Models\FundsSource;
use App\Models\Rack;
use App\Models\Suplier;
use App\Models\Tag;
use App\Models\Warehouse;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Collection $storages;
    public Collection $specifications;
    public $uploadedFiles = [];
    public $images = [];
    public $asset = [];
    public $spec = [];
    public $rack = [];
    public $tag_ids;
    // public $tag_ids = [];
    public $funds_source_id;
    public $lifetime;

    public function mount(Asset $asset)
    {
        $this->asset = $asset->load([
            'assetImages',
            'consumable',
            'tags',
            'racks',
            'assetSpecifications'
        ]);

        $this->tag_ids = $asset->tags->first()?->id;
        $this->lifetime = $asset->consumable->lifetime;
        foreach ($this->asset->assetImages as $image) {
            array_push($this->uploadedFiles, $image->image_url);
            array_push($this->images, $image->id);
        }

        $this->rack = $this->asset->racks->map(function ($item, $key) {
            return [
                'warehouse_id' => $item->warehouse_id,
                'id' => $item->id,
                'qty' => $item->pivot->qty
            ];
        });

        $this->spec = $this->asset->assetSpecifications->map(function ($item, $key) {
            return [
                'name' => $item->name,
                'value' => $item->value
            ];
        });

        $this->storages = $this->asset->racks->map(function () {
            return [
                'warehouse_id' => '',
                'rack_id' => '',
                'qty' => ''
            ];
        });

        $this->specifications = $this->asset->assetSpecifications->map(function () {
            return [
                'name' => '',
                'value' => ''
            ];
        });
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
        return view('livewire.consumable.edit', [
            'tagLists' => $this->tagLists,
            'brandLists' => $this->brandLists,
            'suplierLists' => $this->suplierLists,
            'fundsLists' => $this->fundsLists,
            'warehouseLists' => $this->warehouseLists,
            'rackLists' => $this->rackLists
        ]);
    }

    public function update(UpdateConsumableItem $updateConsumable)
    {
        dd($this->images);
        // Validate data
        $validatedData = $this->validate();

        // Create Item
        $updateConsumable->handle($this->asset['id'], $validatedData);

        $this->emit('consumableTable');
        $this->notify('Barang ' . $this->asset['name'] . ' berhasil diupdate');

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
