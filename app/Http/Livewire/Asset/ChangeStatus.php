<?php

namespace App\Http\Livewire\Asset;

use App\Models\Asset;
use App\Models\StatusAsset;
use LivewireUI\Modal\ModalComponent;

class ChangeStatus extends ModalComponent
{
    public Asset $inputs;
    public $status;

    protected $rules = [
        'inputs.status_asset_id' => 'required',
        'inputs.description' => 'nullable',
        'inputs.used_by' => 'nullable',
        'inputs.used_at' => 'nullable',
        'inputs.rent_at' => 'nullable',
        'inputs.rent_end' => 'nullable',
    ];

    protected $messages = [
        'inputs.status_asset_id.required' => 'Status asset harus dipilih!'
    ];

    public function mount(Asset $asset)
    {
        $this->inputs = $asset;
        $this->statusLists = StatusAsset::pluck('name', 'id');
    }

    public function render()
    {
        $this->status = $this->inputs['status_asset_id'];

        return view('livewire.asset.change-status');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('assetTable');
        $this->closeModal();
        $this->notify('Asset berhasil diupdate');
    }
}
