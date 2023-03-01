<?php

namespace App\Http\Controllers;

class FundsSourceController extends Controller
{
    public function __invoke()
    {
        return view('dash.funds-source');
    }
}
