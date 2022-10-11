<?php

namespace App\Http\Livewire\Rack;

use App\Models\Rack;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public Rack $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:100',
        'inputs.description' => 'nullable',
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama rak harus diisi!',
        'inputs.name.max' => 'Nama rak tidak boleh lebih dari 100 karakter',
    ];

    public function mount(Rack $rack)
    {
        $this->inputs = $rack;
    }

    public function render()
    {
        return view('livewire.rack.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('rackTable');
        $this->closeModal();
        $this->notify('Rak berhasil diupdate');
    }
}
