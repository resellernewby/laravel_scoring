<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AssetImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'main'
    ];

    protected $casts = [
        'main' => 'boolean'
    ];

    public function scopeMain($query)
    {
        return $query->where('main', true);
    }

    public function getImageUrlAttribute()
    {
        $imageUrl = asset('images/no_image.png');

        if (!is_null($this->name)) {
            $directory = config('setting.consumable.image.directory');
            $imagePath = Storage::exists("{$directory}/" . $this->name);

            if ($imagePath) {
                $imageUrl = Storage::url("{$directory}/" . $this->name);
            }
        }

        return $imageUrl;
    }

    public function getImageThumbUrlAttribute()
    {
        $imageUrl = asset('images/no_image.png');

        if (!is_null($this->name)) {
            $directory = config('setting.consumable.image.directory');
            $ext = substr(strrchr($this->name, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->name);
            $imagePath = Storage::exists("{$directory}/" . $thumbnail);

            if ($imagePath) {
                $imageUrl = Storage::url("{$directory}/" . $thumbnail);
            }
        }

        return $imageUrl;
    }
}
