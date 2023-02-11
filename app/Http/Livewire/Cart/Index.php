<?php

namespace App\Http\Livewire\Cart;

use App\Actions\Consumables\CheckoutCartItem;
use App\Models\Cart;
use Livewire\Component;

class Index extends Component
{
    public $cart = [];

    protected $listeners = [
        'addToCart' => '$refresh'
    ];

    public function increment(Cart $cart)
    {
        $ready = $cart->asset->consumable->qty;
        if ($cart->qty < $ready) {
            $cart->increment('qty');
        }
    }

    public function decrement(Cart $cart)
    {
        if ($cart->qty <= 1) {
            return;
        }

        $cart->decrement('qty');
    }

    public function remove(Cart $cart)
    {
        $cart->delete();
    }

    public function render()
    {
        return view('livewire.cart.index', [
            'carts' => $this->carts
        ]);
    }

    public function checkout(CheckoutCartItem $cartItems)
    {
        foreach ($this->cart as $crt => $rack) {
            #
        }
        $cartItems->handle($this->carts);
    }

    public function getCartsProperty()
    {
        return Cart::with(['asset.racks.warehouse'])
            ->where('user_id', auth()->id())
            ->get();
    }
}
