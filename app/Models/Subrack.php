<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subrack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }
}
