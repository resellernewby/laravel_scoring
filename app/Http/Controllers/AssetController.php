<?php

namespace App\Http\Controllers;

class AssetController extends Controller
{
    public function __invoke()
    {
        return view('dash.asset');
    }
}
