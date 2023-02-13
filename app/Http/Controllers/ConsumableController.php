<?php

namespace App\Http\Controllers;

use App\Models\Asset;

class ConsumableController extends Controller
{
    public function index()
    {
        return view('dash.consumable.index');
    }

    public function checkin()
    {
        return view('dash.consumable.checkin');
    }

    public function show()
    {
        return view('dash.consumable.show');
    }

    public function edit(Asset $asset)
    {
        if (!$asset) {
            abort(404);
        }

        return view('dash.consumable.edit', [
            'asset' => $asset
        ]);
    }
}
