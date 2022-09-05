<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'status_asset_id',
        'name',
        'image',
        'serial',
        'barcode',
        'purchase_cost',
        'lifetime',
        'description',
        'warranty_period',
        'purchase_at',
        'used_at',
        'used_by',
        'rent_at',
        'rent_end'
    ];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function subracks()
    {
        return $this->morphToMany(Subrack::class, 'subrackable');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class)->withPivot('used_by', 'current');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function statusAsset()
    {
        return $this->belongsTo(StatusAsset::class);
    }
}
