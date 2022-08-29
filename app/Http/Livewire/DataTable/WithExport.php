<?php

namespace App\Http\Livewire\DataTable;

trait WithExport
{
    public function render()
    {
        return view('livewire.data-table.export');
    }
}
