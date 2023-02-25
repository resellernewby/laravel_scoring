<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'date',
        'location',
        'funds_source_id',
        'suplier_id'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
