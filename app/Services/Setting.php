<?php

namespace App\Services;

use App\Models\Setting as ModelsSetting;
use Illuminate\Support\Facades\Cache;

class Setting
{
    public static function get($key)
    {
        $setting = Cache::get('setting');
        if (!isset($setting[$key])) {
            $setting = Cache::remember('setting', 24 * 60 * 7, function () {
                return ModelsSetting::pluck('value', 'key')->toArray();
            });
        }

        return $setting[$key] ?? null;
    }

    public static function set()
    {
        # code...
    }

    public static function condition($key)
    {
        $data = json_decode(self::get('conditions'), true);
        if (isset($data[$key])) {
            return $data[$key];
        }

        return $key;
    }

    public static function status($key)
    {
        $data = json_decode(self::get('status'), true);
        if (isset($data[$key])) {
            return $data[$key];
        }

        return $key;
    }
}
