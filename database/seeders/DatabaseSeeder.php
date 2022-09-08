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
        \App\Models\User::factory(3)->create();
        \App\Models\Brand::factory(5)->create();

        $this->call([
            LocationSeeder::class,
            WarehouseSeeder::class,
            TagSeeder::class,
            StatusAssetSeeder::class,
        ]);

        \App\Models\Asset::factory(10)->create();
        \App\Models\Consumable::factory(10)->create();
    }
}
