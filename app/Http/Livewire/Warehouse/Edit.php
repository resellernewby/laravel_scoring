<?php

namespace App\Http\Livewire\Warehouse;

use App\Models\Warehouse;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public Warehouse $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:255',
        'inputs.pic' => 'nullable',
        'inputs.description' => 'nullable'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama gudang harus diisi!',
        'inputs.name.max' => 'Nama gudang maksimal 255 karakter'
    ];

    public function mount(Warehouse $warehouse)
    {
        $this->inputs = $warehouse;
    }

    public function render()
    {
        return view('livewire.warehouse.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('warehouseTable');
        $this->closeModal();
        $this->notify('Gudang berhasil diupdate');
    }
}
