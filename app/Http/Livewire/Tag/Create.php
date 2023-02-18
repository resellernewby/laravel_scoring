<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama tag harus diisi!',
        'inputs.name.max' => 'Nama tag lebih dari 50 karakter'
    ];

    public function render()
    {
        return view('livewire.tag.create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['inputs']['slug'] = $validatedData['inputs']['name'];
        Tag::create($validatedData['inputs']);

        $this->emit('tagCreated');
        $this->closeModal();
        $this->notify('Kategori baru berhasil ditambahkan');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
