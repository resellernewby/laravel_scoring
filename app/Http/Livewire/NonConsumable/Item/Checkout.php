<?php

namespace App\Http\Livewire\NonConsumable\Item;

use LivewireUI\Modal\ModalComponent;

class Checkout extends ModalComponent
{
    public function render()
    {
        return view('livewire.non-consumable.item.checkout');
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
