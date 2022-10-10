<?php

namespace App\Http\Livewire\Brand;

use App\Models\Brand;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public Brand $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama merek harus diisi!',
        'inputs.name.max' => 'Nama merek lebih dari 50 karakter'
    ];

    public function mount(Brand $brand)
    {
        $this->inputs = $brand;
    }

    public function render()
    {
        return view('livewire.brand.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('brandTable');
        $this->closeModal();
        $this->notify('Merek berhasil diupdate');
    }
}
