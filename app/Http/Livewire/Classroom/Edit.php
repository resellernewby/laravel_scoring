<?php

namespace App\Http\Livewire\Classroom;

use App\Models\Classroom;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public Classroom $inputs;
    public $status = ['active' => 'active', 'non-active' => 'non-active'];
    

    protected $rules = [
        'inputs.name' => 'required|max:50',
        'inputs.is_active' => 'nullable'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama suplier harus diisi!',
        'inputs.name.max' => 'Nama suplier maksimal 50 karakter',
    ];

    public function mount(Classroom $classroom)
    {
        $this->inputs = $classroom;
    }

    public function render()
    {
        return view('livewire.classroom.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('classroomTable');
        $this->closeModal();
        $this->notify('Classroom berhasil diupdate');
    }
}
