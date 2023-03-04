<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
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

        $this->notify('Pengaturan status barang berhasil disimpan');
    }
}
