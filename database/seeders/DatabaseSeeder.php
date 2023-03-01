<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') !== 'production') {
            \App\Models\User::factory()->create();
            \App\Models\Brand::factory(5)->create();
            \App\Models\Suplier::factory(5)->create();
            \App\Models\FundsSource::factory(2)->create();

            $this->call([
                LocationSeeder::class,
                WarehouseSeeder::class,
                TagSeeder::class,
                ConsumableSeeder::class,
                NonConsumableSeeder::class,
            ]);
        } else {
            DB::table('warehouses')->truncate();
            $warehouse = Warehouse::create([
                'name' => 'Gudang Barang Rusak',
                'description' => 'Gudang Barang Rusak',
                'pic' => 'Iwan'
            ]);

            $warehouse->racks()->create([
                'name' => 'Rak barang rusak',
                'description' => 'tempat nyimpen barang rusak'
            ]);

            DB::table('settings')->insert([
                [
                    'key' => 'logo',
                    'value' => 'logo.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'favicon',
                    'value' => 'favicon.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'company_name',
                    'value' => 'Belum disetting',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'status',
                    'value' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'conditions',
                    'value' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
