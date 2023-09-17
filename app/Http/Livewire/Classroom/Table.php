<?php

namespace App\Http\Livewire\Classroom;

use App\Models\Classroom;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete;
    public $status = ['active' => 'active', 'non-active' => 'non-active'];

    protected $listeners = [
        'classroomTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Classroom::query()
            ->latest();        
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.classroom.table', [
            'classrooms' => $this->rows
        ]);
    }

    public function destroy(Classroom $classroom)
    {
        $this->isDelete = false;
        
        $classroom->delete();        
        $this->notify($classroom->name . ' berhasil dihapus');
    }
}
