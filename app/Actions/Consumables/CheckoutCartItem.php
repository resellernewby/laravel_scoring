<?php

namespace App\Actions\Consumables;

class CheckoutCartItem
{
    public function handle($collections)
    {
        // loop
        foreach ($collections as $item) {
            // Kurangi QTY pada consumable
            $item->asset()->consumable()->decrement('qty', $item->qty);

            // Kurangi QTY pada rak
        }
    }
}
