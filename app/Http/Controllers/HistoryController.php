<?php

namespace App\Http\Controllers;

class HistoryController extends Controller
{
    public function __invoke()
    {
        return view('dash.history');
    }
}
