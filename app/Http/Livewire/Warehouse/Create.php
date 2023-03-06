<?php

namespace App\Http\Livewire\Warehouse;

use App\Models\Warehouse;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $inputs = [];

    protected $rules = [
        'inputs.name' => 'required|max:255',
        'inputs.pic' => 'nullable',
        'inputs.description' => 'nullable'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama gudang harus diisi!',
        'inputs.name.max' => 'Nama gudang maksimal 255 karakter'
    ];

    public function render()
    {
        return view('livewire.warehouse.create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        Warehouse::create($validatedData['inputs']);

        $this->emit('warehouseTable');
        $this->closeModal();
        $this->notify('Gudang baru berhasil ditambahkan');
    }
}
