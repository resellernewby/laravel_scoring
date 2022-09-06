<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug'
    ];

    public function assets()
    {
        return $this->morphedByMany(Asset::class, 'taggable');
    }

    public function consumables()
    {
        return $this->morphedByMany(Consumable::class, 'taggable');
    }

    public function setSlugAttribute($val)
    {
        $this->attributes['slug'] = Str::slug($val);
    }
}
