<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamagedNonConsumableSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sold_at',
        'sold_to',
        'sold_by',
        'sold_price'
    ];

    protected $casts = [
        'sold_at' => 'datetime'
    ];
}
