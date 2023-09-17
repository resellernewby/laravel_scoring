<?php

namespace App\Http\Livewire\Score;

use App\Models\Score;
use App\Traits\ClassroomList;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    use ClassroomList;

    public $inputs = [];

    protected $rules = [
        'inputs.classroom_id' => 'required',
        'inputs.scoring_floor' => 'required|integer|max:5',
        'inputs.scoring_table' => 'required|integer|max:5',
        'inputs.scoring_equipment' => 'required|integer|max:5',
        'inputs.scoring_date' => 'required'
    ];

    protected $messages = [
        'inputs.classroom_id' => 'Nama kelas harus dipilih!',
        'inputs.scoring_floor.required' => 'Nilai lantai harus diisi',
        'inputs.scoring_floor.integer' => 'Nilai lantai harus diisi angka',
        'inputs.scoring_floor.max' => 'Nilai lantai tidak boleh lebih dari 5',
        'inputs.scoring_table.required' => 'Nilai meja harus diisi',
        'inputs.scoring_table.integer' => 'Nilai meja harus diisi angka',
        'inputs.scoring_table.max' => 'Nilai meja tidak boleh lebih dari 5', 
        'inputs.scoring_equipment.required' => 'Nilai peralatan harus diisi',
        'inputs.scoring_equipment.integer' => 'Nilai peralatan harus diisi angka',
        'inputs.scoring_equipment.max' => 'Nilai peralatan tidak boleh lebih dari 5',
        'inputs.scoring_date' => 'Tanggal penilaian harus diisi',
    ];

    public function render()
    {
        return view('livewire.score.create', ['classroomLists' => $this->classroomLists]);
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['inputs']['user_id'] = auth()->id();

        Score::create($validatedData['inputs']);

        $this->emit('scoreTable');
        $this->closeModal();

        $this->notify('Score baru berhasil ditambahkan');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
