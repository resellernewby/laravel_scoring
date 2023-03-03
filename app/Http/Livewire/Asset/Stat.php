<?php

namespace App\Http\Livewire\Asset;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stat extends Component
{
    protected $listeners = [
        'consumableTable' => '$refresh',
        'nonConsumableTable' => '$refresh'
    ];

    public function render()
    {
        $asset = DB::table('assets')
            ->where('type', 'consumable')
            ->selectRaw("count(case when qty > 0 then 1 end) as available")
            ->selectRaw("count(case when qty < 5 then 1 end) as lowstock")
            ->selectRaw("count(case when qty < 1 then 1 end) as outstock")
            ->first();

        return view('livewire.asset.stat', [
            'asset' => $asset
        ]);
    }
}
