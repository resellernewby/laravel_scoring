<?php

namespace App\Http\Livewire\Warehouse;

use App\Models\Warehouse;
use LivewireUI\Modal\ModalComponent;

class AddRack extends ModalComponent
{
    public $warehouse;
    public $inputs = [];

    protected $rules = [
        'inputs.name' => 'required|max:100',
        'inputs.description' => 'nullable',
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama rak harus diisi!',
        'inputs.name.max' => 'Nama rak tidak boleh lebih dari 100 karakter',
    ];

    public function mount(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
    }

    public function render()
    {
        return view('livewire.warehouse.add-rack');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $this->warehouse->racks()->create($validatedData['inputs']);

        $this->emit('warehouseTable');
        $this->emit('rackTable');
        $this->closeModal();
        $this->notify('Rak baru berhasil ditambahkan');
    }
}
