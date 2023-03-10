<?php

namespace App\Http\Controllers;

class LocationController extends Controller
{
    public function __invoke()
    {
        return view('dash.location');
    }
}
