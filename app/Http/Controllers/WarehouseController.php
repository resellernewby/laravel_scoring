<?php

namespace App\Http\Controllers;

class WarehouseController extends Controller
{
    public function __invoke()
    {
        return view('dash.warehouse');
    }
}
