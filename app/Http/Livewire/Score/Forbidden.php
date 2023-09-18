<?php

namespace App\Http\Livewire\Score;

use LivewireUI\Modal\ModalComponent;

class Forbidden extends ModalComponent
{
    public function render()
    {
        return view('livewire.score.forbidden');
    }
}
