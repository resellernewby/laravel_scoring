<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $uris = [
            'consumable',
            'asset'
        ];

        if (!in_array($request->s, $uris)) {
            return view('dash.history', [
                'goto' => 'consumable'
            ]);
        }

        return view('dash.history', [
            'goto' => $request->s
        ]);
    }
}
