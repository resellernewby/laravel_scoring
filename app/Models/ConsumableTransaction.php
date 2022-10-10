<?php

namespace App\Models;

use App\Traits\Numeric;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumableTransaction extends Model
{
    use HasFactory;
    use Numeric;

    protected $fillable = [
        'type',
        'qty',
        'purchase_cost',
        'purchase_at',
        'by'
    ];

    protected $casts = [
        'purchase_at' => 'datetime'
    ];

    public function consumable()
    {
        return $this->belongsTo(Consumable::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function setPurchaseCostAttribute($value)
    {
        $this->attributes['purchase_cost'] = $this->getNumeric($value);
    }

    public function setPurchaseAtAttribute($value)
    {
        $this->attributes['purchase_at'] = date('Y-m-d', strtotime($value));
    }
}
