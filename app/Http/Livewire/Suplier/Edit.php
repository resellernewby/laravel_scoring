<?php

namespace App\Http\Livewire\Suplier;

use App\Models\Suplier;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public Suplier $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama suplier harus diisi!',
        'inputs.name.max' => 'Nama suplier lebih dari 50 karakter'
    ];

    public function mount(Suplier $suplier)
    {
        $this->inputs = $suplier;
    }

    public function render()
    {
        return view('livewire.suplier.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('suplierTable');
        $this->closeModal();
        $this->notify('Suplier berhasil diupdate');
    }
}
