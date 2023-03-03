<?php

namespace App\Traits;

use App\Models\Brand;

trait BrandList
{
    public function getBrandListsProperty()
    {
        return Brand::oldest('name')->pluck('name', 'id');
    }
}
