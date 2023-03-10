<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address'
    ];

    public function nonConsumables()
    {
        return $this->morphMany(NonConsumable::class, 'non_consumable');
    }

    public function nonConsumableTransactions()
    {
        return $this->morphMany(NonConsumableTransaction::class, 'nct_able');
    }

    public function consumableTransactions()
    {
        return $this->hasMany(ConsumableTransaction::class);
    }
}
