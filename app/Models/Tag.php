<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function asset()
    {
        return $this->morphedByMany(Asset::class, 'taggable');
    }

    public function consumable()
    {
        return $this->morphedByMany(Consumable::class, 'taggable');
    }
}
