<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumableTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nct_able_type',
        'nct_able_id',
        'action',
        'condition',
        'date',
        'user',
    ];

    public function nonConsumable()
    {
        return $this->belongsTo(NonConsumable::class);
    }

    public function nctAble()
    {
        return $this->morphTo();
    }
}
