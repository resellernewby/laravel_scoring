<?php

namespace App\Http\Livewire\Location;

use App\Models\Location;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $inputs = [];

    protected $rules = [
        'inputs.name' => 'required|max:50',
        'inputs.address' => 'nullable|max:250'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama lokasi harus diisi!',
        'inputs.name.max' => 'Nama lokasi maksimal 50 karakter',
        'inputs.address.max' => 'Kode maksimal 50 karakter'
    ];

    public function render()
    {
        return view('livewire.location.create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        Location::create($validatedData['inputs']);

        $this->emit('locationCreated');
        $this->closeModal();

        $this->notify('Lokasi baru berhasil ditambahkan');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
