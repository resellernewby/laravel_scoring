<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AssetLocation extends Pivot
{
    protected $casts = ['current' => 'boolean'];
}
