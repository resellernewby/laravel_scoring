<?php

namespace App\Http\Livewire\DamagedAsset;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stat extends Component
{
    protected $listeners = [
        'damagedAssetTable' => '$refresh'
    ];

    public function render()
    {
        $asset = DB::table('non_consumables')
            ->selectRaw("count(case when current_status = 'damaged' then 1 end) as damaged")
            ->selectRaw("count(case when current_status = 'in_repair' then 1 end) as repair")
            ->first();

        $sales = DB::table('damaged_non_consumable_sales')
            ->whereBetween('sold_at', [now()->startOfYear(), now()->endOfYear()])
            ->sum('sold_price');

        return view('livewire.damaged-asset.stat', [
            'asset' => $asset,
            'sales' => $sales
        ]);
    }
}
