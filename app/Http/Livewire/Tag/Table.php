<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = [
        'tagTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Tag::query()
            ->with(['assets', 'consumables'])
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(5);
    }

    public function render()
    {
        return view('livewire.tag.table', [
            'tags' => $this->rows
        ]);
    }
}
