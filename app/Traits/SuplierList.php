<?php

namespace App\Traits;

use App\Models\Suplier;

trait SuplierList
{
    public function getSuplierListsProperty()
    {
        return Suplier::oldest('name')->pluck('name', 'id');
    }
}
