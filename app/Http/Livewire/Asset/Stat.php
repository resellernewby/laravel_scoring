<?php

namespace App\Http\Livewire\Asset;

use App\Services\Setting;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stat extends Component
{
    public $type;

    protected $listeners = [
        'consumableTable' => '$refresh',
        'nonConsumableTable' => '$refresh'
    ];

    public function render()
    {
        $asset = DB::table('assets')
            ->where('type', $this->type)
            ->selectRaw("count(case when qty > 0 then 1 end) as available")
            ->selectRaw("count(case when qty < ? then 1 end) as lowstock", [(int) Setting::get('lowstock')])
            ->selectRaw("count(case when qty < 1 then 1 end) as outstock")
            ->first();

        return view('livewire.asset.stat', [
            'asset' => $asset
        ]);
    }
}
