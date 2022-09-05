<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_assets')->insert([
            [
                'name' => 'in warehouse',
                'item_color' => 'blue',
            ],
            [
                'name' => 'in use',
                'item_color' => 'green',
            ],
            [
                'name' => 'in repair',
                'item_color' => 'red',
            ],
            [
                'name' => 'in rent',
                'item_color' => 'orange',
            ],
            [
                'name' => 'broken',
                'item_color' => 'gray',
            ]
        ]);
    }
}
