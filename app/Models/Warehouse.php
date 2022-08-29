<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'pj'
    ];

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }

    public function asset()
    {
        return $this->morphedByMany(Asset::class, 'warehousable');
    }

    public function consumable()
    {
        return $this->morphedByMany(Consumable::class, 'warehousable');
    }
}
