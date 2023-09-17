<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'classroom_id',
        'scoring_floor',
        'scoring_table',
        'scoring_equipment',
        'scoring_date',
    ];

    protected $casts = [
        'scoring_date' => 'date:Y-m-d',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function getScoringTotalAttribute()
    {
        return $this->scoring_floor + $this->scoring_table + $this->scoring_equipment;
    }
}
