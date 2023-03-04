<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class Index extends Component
{
    public $setting;
    public $company_name;

    protected $rules = [
        'company_name' => 'required|max:250'
    ];

    public function mount()
    {
        $setting = Setting::pluck('value', 'key');
        $this->company_name = $setting['company_name'];
    }

    public function render()
    {
        return view('livewire.setting.index');
    }

    public function store()
    {
        $this->validate();

        Setting::updateOrCreate(
            [
                'key' => 'company_name'
            ],
            [
                'value' => $this->company_name
            ]
        );

        $this->notify('Pengaturan informasi umum berhasil disimpan');
    }
}
