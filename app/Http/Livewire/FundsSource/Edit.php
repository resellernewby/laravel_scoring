<?php

namespace App\Http\Livewire\FundsSource;

use App\Models\FundsSource;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public FundsSource $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50',
        'inputs.code' => 'required|max:50'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama sumber dana harus diisi!',
        'inputs.name.max' => 'Nama sumber dana lebih dari 50 karakter'
    ];

    public function mount(FundsSource $funds)
    {
        $this->inputs = $funds;
    }

    public function render()
    {
        return view('livewire.funds-source.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('fundsTable');
        $this->closeModal();
        $this->notify('Sumber dana berhasil diupdate');
    }
}
