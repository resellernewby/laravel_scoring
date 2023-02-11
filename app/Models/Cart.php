<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'qty'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
