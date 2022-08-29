<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddConsumable extends Model
{
    use HasFactory;

    public function consumable()
    {
        return $this->belongsTo(Consumable::class);
    }
}
