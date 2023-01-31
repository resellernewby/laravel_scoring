<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'pic',
        'type'
    ];

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class);
    }
}
