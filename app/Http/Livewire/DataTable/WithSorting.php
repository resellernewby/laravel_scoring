<?php

namespace App\Http\Livewire\DataTable;

trait WithSorting
{
    public $sortField = 'id';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    public function applySorting($query, $sort = null, $field = null)
    {
        if ($field !== null) {
            $this->sortField = $field;
        }

        return $query->orderBy($this->sortField, $sort ?: $this->sortDirection);
    }
}
