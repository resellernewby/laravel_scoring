<?php

namespace App\Http\Livewire\Consumable;

use App\Services\Setting;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stat extends Component
{
    protected $listeners = [
        'consumableTable' => '$refresh'
    ];

    public function render()
    {
        $consumables = DB::table('consumables')
            ->selectRaw("count(case when qty > 0 then 1 end) as available")
            ->selectRaw("count(case when qty < ? then 1 end) as lowstock", [Setting::get('lowstock')])
            ->selectRaw("count(case when qty < 1 then 1 end) as outstock")
            ->first();

        return view('livewire.consumable.stat', [
            'consumables' => $consumables
        ]);
    }
}
