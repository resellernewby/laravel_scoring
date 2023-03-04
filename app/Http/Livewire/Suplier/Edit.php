<?php

namespace App\Http\Livewire\Suplier;

use App\Models\Suplier;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public Suplier $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50',
        'inputs.phone' => 'required|min:9|max:20',
        'inputs.email' => 'nullable|email|max:50',
        'inputs.address' => 'nullable|min:10|max:250'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama suplier harus diisi!',
        'inputs.name.max' => 'Nama suplier lebih dari 50 karakter',
        'inputs.phone.required' => 'No. HP harus diisi!',
        'inputs.phone.min' => 'No. HP terlalu pendek, mohon input dengan benar',
        'inputs.phone.max' => 'No. HP terlalu panjang, mohon input dengan benar',
        'inputs.email.email' => 'Pastikan anda menginputkan alamat email',
        'inputs.email.max' => 'Email maksimal 50 karakter',
        'inputs.address.min' => 'Alamat kurang jelas',
        'inputs.address.max' => 'Alamat maksimal 50 karakter',
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
