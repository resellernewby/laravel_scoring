<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
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

        $this->notify('Pengaturan kondisi barang berhasil disimpan');
    }
}
