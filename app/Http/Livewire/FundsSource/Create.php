<?php

namespace App\Http\Livewire\FundsSource;

use App\Models\FundsSource;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50',
        'inputs.code' => 'required|max:10|unique:funds_sources,code'
    ];

    protected $messages = [
        'inputs.name.required' => 'Sumber dana harus diisi!',
        'inputs.name.max' => 'Sumber dana maksimal 50 karakter',
        'inputs.code.required' => 'Kode harus diisi!',
        'inputs.code.unique' => 'Kode sudah tersedia!',
        'inputs.code.max' => 'Kode maksimal 50 karakter'
    ];

    public function render()
    {
        return view('livewire.funds-source.create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        FundsSource::create($validatedData['inputs']);

        $this->emit('fundsCreated');
        $this->closeModal();

        $this->notify('Sumber dana baru berhasil ditambahkan');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
