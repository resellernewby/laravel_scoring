<?php

namespace App\Http\Controllers;

class CheckinConsumablController extends Controller
{
    public function __invoke()
    {
        return view('dash.consumable.checkin');
    }
}
