<?php

namespace App\Http\Livewire\NonConsumable;

use App\Actions\NonConsumables\UpdateNonConsumableItem;
use App\Http\Requests\NonConsumableUpdateRequest;
use App\Models\Asset;
use App\Traits\BrandList;
use App\Traits\FundsList;
use App\Traits\SuplierList;
use App\Traits\TagList;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads,
        TagList,
        BrandList,
        SuplierList,
        FundsList;

    public Collection $specifications;
    public $uploadedFiles = [];
    public $images = [];
    public $asset = [];
    public $spec = [];
    public $tag_ids;
    // public $tag_ids = [];
    public $funds_source_id;

    public function mount(Asset $asset)
    {
        $this->asset = $asset->load([
            'assetImages',
            'consumable',
            'tags',
            'assetSpecifications'
        ]);

        $this->tag_ids = $asset->tags->first()?->id;
        foreach ($this->asset->assetImages as $image) {
            array_push($this->uploadedFiles, $image->image_url);
        }

        $this->spec = $this->asset->assetSpecifications->map(function ($item, $key) {
            return [
                'name' => $item->name,
                'value' => $item->value
            ];
        });

        $this->specifications = $this->asset->assetSpecifications->map(function () {
            return [
                'name' => '',
                'value' => ''
            ];
        });
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
        return view('livewire.non-consumable.edit', [
            'tagLists' => $this->tagLists,
            'brandLists' => $this->brandLists,
            'suplierLists' => $this->suplierLists,
            'fundsLists' => $this->fundsLists
        ]);
    }

    public function update(UpdateNonConsumableItem $updateConsumable)
    {
        // Validate data
        $validatedData = $this->validate();

        // Create Item
        $updateConsumable->handle($this->asset['id'], $validatedData);

        $this->emit('nonConsumableTable');
        $this->notify('Barang ' . $this->asset['name'] . ' berhasil diupdate');

        return redirect()->route('non-consumable.index');
    }

    public function rules()
    {
        $rules = (new NonConsumableUpdateRequest())->rules();
        $rules['asset.barcode'] = ['required', 'unique:assets,barcode,' . $this->asset['id']];
        $rules['asset.model'] = ['required', 'unique:assets,model,' . $this->asset['id']];

        return $rules;
    }

    public function messages()
    {
        return (new NonConsumableUpdateRequest())->messages();
    }
}
