<?php

namespace App\Http\Livewire\Consumable;

use App\Actions\Consumables\UpdateConsumableItem;
use App\Http\Requests\ConsumableRequest;
use App\Models\Asset;
use App\Traits\BrandList;
use App\Traits\FundsList;
use App\Traits\RackList;
use App\Traits\SuplierList;
use App\Traits\TagList;
use App\Traits\WarehouseList;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
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
    public $uploadedFiles = [];
    public $images = [];
    public $asset = [];
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
        }

        $this->rack = $this->asset->racks->map(function ($item, $key) {
            return [
                'warehouse_id' => $item->warehouse_id,
                'id' => $item->id,
                'qty' => $item->pivot->qty
            ];
        });

        $this->storages = $this->asset->racks->map(function () {
            return [
                'warehouse_id' => '',
                'rack_id' => '',
                'qty' => ''
            ];
        });

        $this->spec = collect(
            $this->asset->assetSpecifications()->get(['name', 'value'])
        );
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
        // dump($this->spec);
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
        $rules = (new ConsumableRequest())->rules();
        $rules['asset.barcode'] = ['required', 'unique:assets,barcode,' . $this->asset['id']];

        return $rules;
    }

    public function messages()
    {
        return (new ConsumableRequest())->messages();
    }
}
