<?php

namespace App\Http\Livewire\Location;

use App\Models\Location;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public Location $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50',
        'inputs.address' => 'nullable|max:250'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama lokasi harus diisi!',
        'inputs.name.max' => 'Nama lokasi maksimal 50 karakter',
        'inputs.address.max' => 'Kode maksimal 50 karakter'
    ];

    public function mount(Location $location)
    {
        $this->inputs = $location;
    }

    public function render()
    {
        return view('livewire.location.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('locationTable');
        $this->closeModal();
        $this->notify('Lokasi berhasil diupdate');
    }
}
