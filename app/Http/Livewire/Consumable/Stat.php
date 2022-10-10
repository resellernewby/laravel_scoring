<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Consumable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stat extends Component
{
    public $available;
    public $low;
    public $out;

    protected $listeners = [
        'consumableTable' => '$refresh'
    ];

    public function render()
    {
        $this->available = Consumable::query()
            ->whereHas('consumableTransactions', function ($q) {
                $q->select(DB::raw('SUM(qty) as available'))
                    ->havingRaw('available > 0');
            })
            ->count();

        $this->low = Consumable::query()
            ->whereHas('consumableTransactions', function ($q) {
                $q->select(DB::raw('SUM(qty) as available'))
                    ->havingRaw('available < 5');
            })
            ->count();

        $this->out = Consumable::query()
            ->whereHas('consumableTransactions', function ($q) {
                $q->select(DB::raw('SUM(qty) as available'))
                    ->havingRaw('available < 1');
            })
            ->count();

        return view('livewire.consumable.stat');
    }
}
