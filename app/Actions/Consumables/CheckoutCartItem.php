<?php

namespace App\Actions\Consumables;

use App\Models\Order;

class CheckoutCartItem
{
    public function handle($collections, $taken_by)
    {
        // loop
        foreach ($collections as $item) {
            // Kurangi QTY pada consumable
            $item->asset->consumable()->decrement('qty', $item->qty);

            // Update QTY pada rak
            foreach ($item->taken_item_on_racks as $taken) {
                $item->asset->racks()->updateExistingPivot($taken['rack_id'], [
                    'qty' => $taken['remaining_qty']
                ]);
            }

            // Create Order checkout from taken_by
            $order = Order::create([
                'name' => $taken_by,
                'status' => 'checkout',
                'date' => now(),
            ]);

            // Create Transaction checkout from taken_by
            $item->asset->transactions()->create([
                'order_id' => $order->id,
                'qty' => $item->qty,
                'price' => $item->asset->current_price
            ]);

            // Delete item from cart
            $item->delete();
        }
    }
}
