<?php

namespace App\Http\Controllers;

use App\Models\Asset;

class ConsumableController extends Controller
{
    public function index()
    {
        return view('consumable.index');
    }

    public function checkin()
    {
        return view('consumable.checkin');
    }

    public function show($asset)
    {
        $asset = Asset::query()
            ->with([
                'consumable.consumableTransactions',
                'brand',
                'suplier',
                'fundsSource',
                'racks.warehouse'
            ])
            ->findOrFail($asset);

        return view('consumable.show', [
            'asset' => $asset
        ]);
    }

    public function edit(Asset $asset)
    {
        if (!$asset) {
            abort(404);
        }

        return view('consumable.edit', [
            'asset' => $asset
        ]);
    }
}
