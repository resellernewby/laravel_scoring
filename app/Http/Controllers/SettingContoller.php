<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingContoller extends Controller
{
    public function index()
    {
        return view('setting.index');
    }

    public function notification()
    {
        return view('setting.notification');
    }

    public function condition()
    {
        return view('setting.condition');
    }

    public function status()
    {
        return view('setting.status');
    }
}
