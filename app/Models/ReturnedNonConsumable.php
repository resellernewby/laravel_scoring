<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedNonConsumable extends Model
{
    use HasFactory;

    protected $fillable = [
        'non_consumable_id',
        'rack_id',
        'returned_at',
        'returned_by',
        'condition',
        'description',
    ];
}
