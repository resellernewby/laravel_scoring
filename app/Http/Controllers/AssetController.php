<?php

namespace App\Http\Controllers;

class AssetController extends Controller
{
    public function index()
    {
        return view('dash.asset');
    }

    public function images($id)
    {
        # code...
    }
}
