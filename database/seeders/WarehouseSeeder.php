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
                'name' => 'Gudang Barang Rusak',
                'description' => 'Gudang Barang Rusak',
                'pic' => 'Iwan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gudang A',
                'description' => 'Lorem ipsum dolor sit amet',
                'pic' => 'Amar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gudang B',
                'description' => 'Lorem ipsum dolor sit amet',
                'pic' => 'Doni',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        $warehouses = Warehouse::get();
        foreach ($warehouses as $warehouse) {
            if ($warehouse->name === 'Gudang Barang Rusak') {
                $warehouse->racks()->create([
                    'name' => 'Rak barang rusak',
                    'description' => 'tempat nyimpen barang rusak'
                ]);

                continue;
            }

            $warehouse->racks()->createMany([
                [
                    'name' => 'Rak 1',
                    'description' => 'tempat nyimpen perkakas'
                ],
                [
                    'name' => 'Rak 2',
                    'description' => 'tempat nyimpen spare part'
                ]
            ]);
        }
    }
}
