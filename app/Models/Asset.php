<?php

namespace App\Models;

use App\Traits\Numeric;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    use Numeric;

    protected $fillable = [
        'suplier_id',
        'brand_id',
        'barcode',
        'name',
        'type',
        'current_price'
    ];

    public function consumable()
    {
        return $this->hasOne(Consumable::class);
    }

    public function nonConsumables()
    {
        return $this->hasMany(NonConsumable::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function assetSpecifications()
    {
        return $this->hasMany(AssetSpecification::class);
    }

    public function weeklyReports()
    {
        return $this->hasMany(WeeklyReport::class);
    }

    public function racks()
    {
        return $this->belongsToMany(Rack::class);
    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function assetImages()
    {
        return $this->hasMany(AssetImage::class);
    }

    public function imageFirst()
    {
        return $this->hasOne(AssetImage::class)
            ->main()
            ->withDefault([
                'image_thumb_url' => public_path('images/no_image.png')
            ]);
    }
}
