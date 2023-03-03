<?php

namespace App\Traits;

use App\Models\Warehouse;

trait WarehouseList
{
    public function getWarehouseListsProperty()
    {
        return Warehouse::where('id', '<>', config('setting.warehouse_id_for_damaged'))
            ->oldest('name')
            ->pluck('name', 'id');
    }
}
