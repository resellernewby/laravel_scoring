<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsumableController extends Controller
{
    public function __invoke()
    {
        return view('dash.consumable');
    }
}
