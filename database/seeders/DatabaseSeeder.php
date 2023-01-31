<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create();
        \App\Models\Brand::factory(5)->create();
        \App\Models\Suplier::factory(5)->create();

        $this->call([
            LocationSeeder::class,
            WarehouseSeeder::class,
            TagSeeder::class,
            ConsumableSeeder::class,
            NonConsumableSeeder::class,
        ]);
    }
}
