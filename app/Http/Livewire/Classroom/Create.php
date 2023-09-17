<?php

namespace App\Http\Livewire\Classroom;

use App\Models\Classroom;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $inputs = [];    
    public $status = ['active' => 'active', 'non-active' => 'non-active'];

    protected $rules = [
        'inputs.name' => 'required|max:50',
        'inputs.is_active' => 'nullable'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama suplier harus diisi!',
        'inputs.name.max' => 'Nama suplier maksimal 50 karakter',
    ];
    
    public function render()
    {
        return view('livewire.classroom.create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        Classroom::create($validatedData['inputs']);

        $this->emit('classroomTable');
        $this->closeModal();

        $this->notify('Classroom baru berhasil ditambahkan');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
