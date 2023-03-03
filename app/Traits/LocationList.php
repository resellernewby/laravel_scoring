<?php

namespace App\Traits;

use App\Models\Location;

trait LocationList
{
    public function getLocationListsProperty()
    {
        return Location::oldest('name')->pluck('name', 'id');
    }
}
