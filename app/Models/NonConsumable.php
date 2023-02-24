<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumable extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'non_consumable_id',
        'non_consumable_type',
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

    protected $casts = [
        'purchase_date' => 'date'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function nonConsumableTransactions()
    {
        return $this->hasMany(NonConsumableTransaction::class);
    }

    public function nonConsumable()
    {
        return $this->morphTo();
    }
}
