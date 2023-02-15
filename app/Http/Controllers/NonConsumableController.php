<?php

namespace App\Http\Controllers;

use App\Models\Asset;

class NonConsumableController extends Controller
{
    public function index()
    {
        return view('non-consumable.index');
    }

    public function checkin()
    {
        return view('non-consumable.checkin');
    }

    public function show(Asset $asset)
    {
        if (!$asset) {
            abort(404);
        }

        return view('non-consumable.show', [
            'asset' => $asset
        ]);
    }

    public function edit(Asset $asset)
    {
        if (!$asset) {
            abort(404);
        }

        return view('non-consumable.edit', [
            'asset' => $asset
        ]);
    }
}
