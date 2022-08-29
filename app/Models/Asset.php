<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function warehouses()
    {
        return $this->morphToMany(Warehouse::class, 'warehousable');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
