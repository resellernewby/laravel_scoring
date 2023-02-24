<?php

namespace App\Http\Livewire\NonConsumable;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stat extends Component
{
    protected $listeners = [
        'nonConsumableTable' => '$refresh'
    ];

    public function render()
    {
        $nonConsumables = DB::table('non_consumables')
            ->selectRaw("count(case when current_status = 'in stock' then 1 end) as available")
            ->selectRaw("count(case when current_status = 'in use' then 1 end) as used")
            ->selectRaw("count(case when current_status = 'damaged' then 1 end) as damaged")
            ->first();

        return view('livewire.non-consumable.stat', [
            'nonConsumables' => $nonConsumables
        ]);
    }
}
