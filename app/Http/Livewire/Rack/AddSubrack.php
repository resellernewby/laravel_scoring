<?php

namespace App\Http\Livewire\Rack;

use App\Models\Rack;
use LivewireUI\Modal\ModalComponent;

class AddSubrack extends ModalComponent
{
    public $rack;
    public $inputs = [];

    protected $rules = [
        'inputs.name' => 'required|max:100',
        'inputs.description' => 'nullable',
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama subrak harus diisi!',
        'inputs.name.max' => 'Nama subrak tidak boleh lebih dari 100 karakter',
    ];

    public function mount(Rack $rack)
    {
        $this->rack = $rack;
    }

    public function render()
    {
        return view('livewire.rack.add-subrack');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $this->rack->subracks()->create($validatedData['inputs']);

        $this->emit('rackTable');
        $this->closeModal();
        $this->notify('Subrak baru berhasil ditambahkan');
    }
}
