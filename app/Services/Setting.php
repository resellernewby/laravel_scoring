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
            $setting = Cache::remember('setting', 24 * 60, function () {
                return ModelsSetting::pluck('value', 'key')->toArray();
            });
        }

        return $setting[$key] ?? null;
    }
}
