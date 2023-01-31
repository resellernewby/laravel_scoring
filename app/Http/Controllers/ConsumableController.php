<?php

namespace App\Http\Controllers;

class ConsumableController extends Controller
{
    public function __invoke()
    {
        return view('dash.consumable.index');
    }
}
