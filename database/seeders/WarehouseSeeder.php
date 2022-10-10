<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warehouses')->insert([
            [
                'name' => 'Gudang A',
                'description' => 'Lorem ipsum dolor sit amet',
                'pj' => 'Amar'
            ],
            [
                'name' => 'Gudang B',
                'description' => 'Lorem ipsum dolor sit amet',
                'pj' => 'Doni'
            ]
        ]);

        $warehouses = Warehouse::get();
        foreach ($warehouses as $warehouse) {
            $racks = $warehouse->racks()->createMany([
                [
                    'name' => 'Rak 1',
                    'description' => 'tempat nyimpen perkakas'
                ],
                [
                    'name' => 'Rak 2',
                    'description' => 'tempat nyimpen spare part'
                ]
            ]);

            foreach ($racks as $rack) {
                $rack->subracks()->createMany([
                    [
                        'name' => 'A1',
                        'description' => 'Persabunan'
                    ],
                    [
                        'name' => 'B2',
                        'description' => 'perbautan'
                    ]
                ]);
            }
        }
    }
}
