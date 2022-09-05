<?php

namespace App\Models;

use App\Traits\Numeric;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddConsumable extends Model
{
    use HasFactory;
    use Numeric;

    protected $fillable = [
        'qty',
        'purchase_cost',
        'purchase_at',
    ];

    protected $casts = [
        'purchase_at' => 'date'
    ];

    public function consumable()
    {
        return $this->belongsTo(Consumable::class);
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
