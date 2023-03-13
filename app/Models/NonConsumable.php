<?php

namespace App\Models;

use App\Traits\Search;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumable extends Model
{
    use HasFactory;
    use Search;

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
        'warranty_provider',
        'used_at',
        'used_end'
    ];

    protected $search = [
        'serial', 'user', 'warranty_provider'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'used_at' => 'date',
        'used_end' => 'date',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function nonConsumableTransactions()
    {
        return $this->hasMany(NonConsumableTransaction::class);
    }

    public function returnedNonConsumables()
    {
        return $this->hasMany(ReturnedNonConsumable::class);
    }

    public function returnedDamaged()
    {
        return $this->hasOne(ReturnedNonConsumable::class)
            ->where('condition', 'bad')
            ->latest('id');
    }

    public function damagedNonConsumableSale()
    {
        return $this->hasOne(DamagedNonConsumableSale::class);
    }

    public function nonConsumable()
    {
        return $this->morphTo();
    }

    public function remainingWarranty(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->warranty_period > 1 ? Carbon::now()->diffInDays($this->purchase_date->addMonth($this->warranty_period), false) : null
        );
    }
}
