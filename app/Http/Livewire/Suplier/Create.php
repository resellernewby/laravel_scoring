<?php

namespace App\Http\Livewire\Suplier;

use App\Models\Suplier;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50',
        'inputs.phone' => 'required|min:9|max:20',
        'inputs.email' => 'nullable|email|max:50',
        'inputs.address' => 'nullable|min:10|max:250'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama suplier harus diisi!',
        'inputs.name.max' => 'Nama suplier maksimal 50 karakter',
        'inputs.phone.required' => 'No. HP harus diisi!',
        'inputs.phone.min' => 'No. HP terlalu pendek, mohon input dengan benar',
        'inputs.phone.max' => 'No. HP terlalu panjang, mohon input dengan benar',
        'inputs.email.email' => 'Pastikan anda menginputkan alamat email',
        'inputs.email.max' => 'Email maksimal 50 karakter',
        'inputs.address.min' => 'Alamat kurang jelas',
        'inputs.address.max' => 'Alamat maksimal 50 karakter',
    ];

    public function render()
    {
        return view('livewire.suplier.create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        Suplier::create($validatedData['inputs']);

        $this->emit('suplierCreated');
        $this->closeModal();

        $this->notify('Suplier baru berhasil ditambahkan');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
