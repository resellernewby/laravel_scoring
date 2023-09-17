<?php

namespace App\Http\Controllers;

class ClassroomController extends Controller
{
    public function __invoke()
    {
        return view('dash.classroom');
    }
}
