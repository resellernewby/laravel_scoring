<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class)
            ->withPivot(['qty']);
    }

    public function nonConsumables()
    {
        return $this->morphMany(NonConsumable::class, 'non_consumable');
    }
}
