<?php

namespace App\Http\Controllers;

class ScoreController extends Controller
{
    public function __invoke()
    {
        return view('dash.score');
    }
}
