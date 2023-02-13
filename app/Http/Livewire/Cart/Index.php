<?php

namespace App\Http\Livewire\Cart;

use App\Actions\Consumables\CheckoutCartItem;
use App\Models\Cart;
use Livewire\Component;

class Index extends Component
{
    public $item = [];
    public $taken_by;

    protected $listeners = [
        'addToCart' => '$refresh'
    ];

    protected $rules = [
        'taken_by' => ['required', 'string', 'max:150']
    ];

    protected $messages = [
        'taken_by.required' => 'Nama pengambil harus diisi!',
        'taken_by.string' => 'Nama pengambil harus berupa huruf',
        'taken_by.max' => 'Nama pengambil maksimal 150 karakter'
    ];

    public function increment(Cart $cart)
    {
        $ready = $cart->asset->consumable->qty;
        if ($cart->qty >= $ready) {
            $this->notify('Stok terbatas', 'warning');
            return;
        }

        $cart->increment('qty');
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
        if (count($this->item) < 1) {
            $this->notify('Rak tempat pengambilan belum dipilih', 'warning');
            return;
        }

        if (empty($this->carts)) {
            return;
        }

        foreach ($this->item as $key => $rack) {
            $error = true;
            $totalRackValue = 0;
            $taken = $this->carts[$key]->qty;
            $takenItemOnRacks = [];

            foreach ($rack as $rackId => $rackValue) {
                if (!$rackValue) {
                    continue;
                }

                $totalRackValue += $rackValue;
                $remaining = $totalRackValue - $taken;
                if ($totalRackValue > $taken) {
                    $error = false;
                }

                $takenItemOnRacks[] = [
                    'rack_id' => $rackId,
                    'remaining_qty' => ($remaining < 0 ? 0 : $remaining)
                ];
            }

            if ($error) {
                $this->notify("Rak pengambilan <strong>{$this->carts[$key]->asset->name}</strong> belum dipilih atau tidak mencukupi", 'warning');
                return;
            }

            $this->carts[$key]->taken_item_on_racks = $takenItemOnRacks;
        }

        $this->validate();

        $cartItems->handle($this->carts, $this->taken_by);

        $this->emit('consumableTable');
        $this->notify('Chekout barang berhasil diproses');

        return redirect()->route('consumable.index');
    }

    public function getCartsProperty()
    {
        return Cart::with(['asset.racks.warehouse'])
            ->where('user_id', auth()->id())
            ->get();
    }
}
