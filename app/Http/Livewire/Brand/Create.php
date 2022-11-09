<?php

namespace App\Http\Livewire\Brand;

use App\Models\Brand;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama merek harus diisi!',
        'inputs.name.max' => 'Nama merek lebih dari 50 karakter'
    ];

    public function render()
    {
        return view('livewire.brand.create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['inputs']['slug'] = $validatedData['inputs']['name'];
        Brand::create($validatedData['inputs']);

        $this->emit('brandTable');
        $this->emit('assetCreate');
        $this->emit('consumableCreate');
        $this->closeModal();

        $this->notify('Merek baru berhasil ditambahkan');
    }
}
