<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public Tag $inputs;

    protected $rules = [
        'inputs.name' => 'required|max:50'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama tag harus diisi!',
        'inputs.name.max' => 'Nama tag lebih dari 50 karakter'
    ];

    public function mount(Tag $tag)
    {
        $this->inputs = $tag;
    }

    public function render()
    {
        return view('livewire.tag.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs['slug'] = $this->inputs['name'];
        $this->inputs->save();

        $this->emit('tagTable');
        $this->closeModal();
        $this->notify('Kategori berhasil diupdate');
    }
}
