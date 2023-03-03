<?php

namespace App\Models;

use App\Traits\Numeric;
use App\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    use Numeric;
    use Search;

    protected $fillable = [
        'suplier_id',
        'funds_source_id',
        'brand_id',
        'barcode',
        'model',
        'name',
        'type',
        'qty',
        'current_price',
        'purchase_at'
    ];

    protected $search = [
        'barcode', 'model', 'name'
    ];

    protected $casts = [
        'purchase_at' => 'date'
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
        return $this->belongsToMany(Rack::class)
            ->withPivot(['qty']);
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

    public function fundsSource()
    {
        return $this->belongsTo(FundsSource::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
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
                'image_thumb_url' => public_path('images/photo-off.svg')
            ]);
    }
}
