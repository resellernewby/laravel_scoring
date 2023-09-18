<?php

namespace App\Http\Livewire\Score;

use App\Models\Score;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete;

    protected $listeners = [
        'scoreTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Score::query()
            ->latest();
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.score.table', [
            'scores' => $this->rows
        ]);
    }

    public function destroy(Score $score)
    {
        if (auth()->user()->role != 'admin' && $score->user_id != auth()->id()) {
            $this->notify("You're not allowed");
            return;
        }

        $this->isDelete = false;

        $score->delete();
        $this->notify($score->name . ' berhasil dihapus');
    }
}
