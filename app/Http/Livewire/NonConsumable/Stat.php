<?php

namespace App\Http\Livewire\NonConsumable;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stat extends Component
{
    protected $listeners = [
        'nonConsumableTable' => '$refresh',
        'itemTable' => '$refresh'
    ];

    public function render()
    {
        $nonConsumables = DB::table('assets')
            ->selectRaw("count(case when qty > 0 then 1 end) as available")
            ->selectRaw("count(case when qty < 5 then 1 end) as lowstock")
            ->selectRaw("count(case when qty < 1 then 1 end) as outstock")
            ->first();

        return view('livewire.non-consumable.stat', [
            'nonConsumables' => $nonConsumables,

        ]);
    }
}
