<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $isDelete;

    protected $listeners = [
        'tagTable' => '$refresh'
    ];

    public function getRowsQueryProperty()
    {
        return Tag::query()
            ->with(['assets'])
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.tag.table', [
            'tags' => $this->rows
        ]);
    }

    public function destroy(Tag $tag)
    {
        $this->isDelete = false;

        if ($tag->assets()->count() > 0) {
            $this->notify($tag->name . ' tidak bisa dihapus!', 'warning');
            return;
        }

        $tag->delete();
        $this->notify($tag->name . ' berhasil dihapus');
    }
}
