<?php

namespace App\Traits;

use App\Models\FundsSource;

trait FundsList
{
    public function getFundsListsProperty()
    {
        return FundsSource::oldest('name')->pluck('name', 'id');
    }
}
