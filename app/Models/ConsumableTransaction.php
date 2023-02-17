<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumableTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'action',
        'qty',
        'date',
        'user'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function consumable()
    {
        return $this->belongsTo(Consumable::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
