<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Status extends Component
{
    public $status = [];

    protected $rules = [
        'status.*' => 'required|max:250'
    ];

    public function mount()
    {
        $setting = Setting::pluck('value', 'key');
        if (isset($setting['status'])) {
            $this->status = json_decode($setting['status'], true);
        }
    }

    public function render()
    {
        return view('livewire.setting.status');
    }

    public function store()
    {
        $this->validate();

        Setting::updateOrCreate(
            [
                'key' => 'status'
            ],
            [
                'value' => json_encode($this->status)
            ]
        );

        Cache::forget('setting');
        Cache::remember('setting', 24 * 60 * 7, function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        $this->notify('Pengaturan status barang berhasil disimpan');
    }
}
