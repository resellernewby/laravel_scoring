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
            ->where('type', 'non-consumable')
            ->findOrFail($asset);

        return view('non-consumable.show', [
            'asset' => $asset
        ]);
    }

    public function edit($asset)
    {
        $asset = Asset::query()
            ->where('type', 'non-consumable')
            ->findOrFail($asset);

        return view('non-consumable.edit', [
            'asset' => $asset
        ]);
    }
}
