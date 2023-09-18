<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getIsActiveAttribute()
    {
        return $this->attributes['is_active'] ? 'active' : 'non-active';
    }

    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = $value === 'active' ? true : false;
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
