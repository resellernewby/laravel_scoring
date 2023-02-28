<?php

namespace App\Http\Livewire\Setting;

use App\Services\Setting;
use Livewire\Component;

class Status extends Component
{
    public $status = [];

    public function mount()
    {
        $this->status = Setting::get('status');
    }

    public function render()
    {
        return view('livewire.setting.status');
    }
}
