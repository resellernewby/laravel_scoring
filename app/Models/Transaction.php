<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'order_id',
        'qty',
        'price'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
