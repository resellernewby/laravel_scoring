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
                'item_color' => 'bg-green-300',
            ],
            [
                'name' => 'in use',
                'item_color' => 'bg-blue-300',
            ],
            [
                'name' => 'in repair',
                'item_color' => 'bg-red-300',
            ],
            [
                'name' => 'broken',
                'item_color' => 'bg-gray-300',
            ]
        ]);
    }
}
