<?php

namespace App\Models;

use App\Traits\Numeric;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
    use HasFactory;
    use Numeric;

    protected $fillable = [
        'brand_id',
        'name',
        'qty',
        'image',
        'barcode',
        'lifetime',
        'description',
        'item_price',
        'purchase_at'
    ];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function subracks()
    {
        return $this->morphToMany(Subrack::class, 'subrackable');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function addConsumables()
    {
        return $this->hasMany(AddConsumable::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class)->withPivot('qty', 'used_by');
    }

    public function setItemPriceAttribute($value)
    {
        $this->attributes['item_price'] =  $this->getNumeric($value);
    }
}
