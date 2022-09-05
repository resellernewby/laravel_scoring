<?php

namespace App\Http\Livewire\Asset;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\Rack;
use App\Models\StatusAsset;
use App\Models\Subrack;
use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public $brandLists;
    public $statusLists;
    public $rackLists;
    public $subrackLists;
    public Asset $inputs;
    public $tags;
    public $rack;
    public $subrack;

    protected $rules = [
        'inputs.name' => 'required|max:255',
        'inputs.status_asset_id' => 'required',
        'inputs.brand_id' => 'required',
        'inputs.serial' => 'required|max:50',
        'inputs.barcode' => 'nullable',
        'inputs.purchase_cost' => 'required',
        'inputs.purchase_at' => 'required',
        'inputs.warranty_period' => 'nullable',
        'inputs.lifetime' => 'nullable',
        'inputs.description' => 'nullable',
        'inputs.used_by' => 'nullable',
        'inputs.used_at' => 'nullable',
        'inputs.rent_at' => 'nullable',
        'inputs.rent_end' => 'nullable',
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama barang harus diisi!',
        'inputs.name.max' => 'Nama barang maksimal 255 karakter',
        'inputs.status_asset_id.required' => 'Status asset harus dipilih!',
        'inputs.brand_id.required' => 'Merek asset harus dipilih!',
        'inputs.serial.required' => 'Serial number harus diisi!',
        'inputs.serial.max' => 'serial number terlalu panjang',
        'inputs.purchase_cost.required' => 'Harga beli harus diisi!',
        'inputs.purchase_at.required' => 'Tanggal beli harus diisi!'
    ];

    public function mount(Asset $asset)
    {
        $this->inputs = $asset;
        $this->tags = $asset?->tags->pluck('name', 'id');
        $this->brandLists = Brand::pluck('name', 'id');
        $this->statusLists = StatusAsset::pluck('name', 'id');
        $this->tagLists = Tag::pluck('name', 'id');
        $racks = Rack::with('warehouse')->get();
        $this->rackLists = collect();
        foreach ($racks as $rack) {
            $this->rackLists->put($rack->id, $rack->name . '/' . $rack?->warehouse?->name);
        }
    }

    public function render()
    {
        if ($this->rack) {
            $this->subrackLists = Subrack::where('rack_id', $this->rack)
                ->pluck('name', 'id');
        }

        return view('livewire.asset.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();
        $this->inputs->subracks()->sync($this->subrack);

        if (is_array($this->tags) && count($this->tags) > 0) {
            $this->inputs->tags()->sync($this->tags);
        }

        $this->emit('assetTable');
        $this->closeModal();
        $this->notify('Asset berhasil diupdate');
    }
}
