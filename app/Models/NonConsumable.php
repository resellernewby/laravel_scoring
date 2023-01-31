<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumable extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'user',
        'serial',
        'economic_age',
        'residual_value',
        'price',
        'condition',
        'current_status',
        'purchase_date',
        'warranty_period',
        'warranty_provider'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function nonConsumableTransactions()
    {
        return $this->hasMany(NonConsumableTransaction::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
