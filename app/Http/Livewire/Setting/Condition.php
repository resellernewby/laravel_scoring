<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Condition extends Component
{
    public $conditions = [];

    protected $rules = [
        'conditions.*' => 'required|max:250'
    ];

    public function mount()
    {
        $setting = Setting::pluck('value', 'key');
        if (isset($setting['conditions'])) {
            $this->conditions = json_decode($setting['conditions'], true);
        }
    }

    public function render()
    {
        return view('livewire.setting.condition');
    }

    public function store()
    {
        $this->validate();

        Setting::updateOrCreate(
            [
                'key' => 'conditions'
            ],
            [
                'value' => json_encode($this->conditions)
            ]
        );

        Cache::forget('setting');
        Cache::remember('setting', 24 * 60 * 7, function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        $this->notify('Pengaturan kondisi barang berhasil disimpan');
    }
}
