<?php

namespace App\Http\Livewire\Rack;

use App\Models\Subrack;
use LivewireUI\Modal\ModalComponent;

class EditSubrack extends ModalComponent
{
    public Subrack $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:100',
        'inputs.description' => 'nullable',
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama subrak harus diisi!',
        'inputs.name.max' => 'Nama subrak tidak boleh lebih dari 100 karakter',
    ];

    public function mount(Subrack $subrack)
    {
        $this->inputs = $subrack;
    }

    public function render()
    {
        return view('livewire.rack.edit-subrack');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('rackTable');
        $this->closeModal();
        $this->notify('Subrak berhasil diupdate');
    }
}
