<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Notification extends Component
{
    public $lowstock;
    public $notif_hour;

    protected $rules = [
        'lowstock' => 'required|min:1|max:3',
        'notif_hour' => 'required'
    ];

    public function mount()
    {
        $setting = Setting::pluck('value', 'key');
        $this->lowstock = $setting['lowstock'];
        $this->notif_hour = $setting['notif_hour'];
    }

    public function render()
    {
        return view('livewire.setting.notification');
    }

    public function store()
    {
        $this->validate();

        Setting::updateOrCreate(
            [
                'key' => 'lowstock'
            ],
            [
                'value' => $this->lowstock
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'notif_hour'
            ],
            [
                'value' => $this->notif_hour
            ]
        );

        Cache::forget('setting');
        Cache::remember('setting', 24 * 60 * 7, function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        $this->notify('Pengaturan notifikasi berhasil disimpan');
    }
}
