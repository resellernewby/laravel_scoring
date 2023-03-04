<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class Condition extends Component
{
    public $condition = [];

    protected $rules = [
        'conditon.*' => 'required|max:250'
    ];

    public function mount()
    {
        $setting = Setting::pluck('value', 'key');
        if (isset($setting['condition'])) {
            $this->condition = json_decode($setting['condition'], true);
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
                'key' => 'condition'
            ],
            [
                'value' => json_encode($this->condition)
            ]
        );

        $this->notify('Pengaturan kondisi barang berhasil disimpan');
    }
}
