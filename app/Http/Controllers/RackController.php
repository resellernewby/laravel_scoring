<?php

namespace App\Http\Controllers;

class RackController extends Controller
{
    public function __invoke($id)
    {
        return view('dash.rack', [
            'warehouseId' => $id
        ]);
    }
}
