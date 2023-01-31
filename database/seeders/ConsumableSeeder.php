<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Suplier;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsumableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consumableAsset = Asset::create([
            'suplier_id' => Suplier::pluck('id')->random(),
            'brand_id' => Brand::pluck('id')->random(),
            'barcode' => fake()->isbn13(),
            'name' => fake()->randomElement(['catridge', 'spidol', 'tissue', 'kertas', 'tinta']),
            'type' => 'consumable',
            'current_price' => fake()->randomNumber(5, true)
        ]);

        $warehouse = Warehouse::with('racks')->inRandomOrder()->first();
        $consumableAsset->warehouses()->attach($warehouse->id, ['qty' => 1, 'price' => fake()->randomNumber(6, true)]);
        $consumableAsset->racks()->attach($warehouse->racks->first()->id, ['qty' => 1]);

        $order = Order::create([
            'name' => 'CV. Rafah',
            'status' => 'new stock',
            'date' => now()
        ]);

        $consumableAsset->transactions()->create([
            'order_id' => $order->id,
            'qty' => mt_rand(1, 10),
            'price' => fake()->randomNumber(6, true)
        ]);

        $consumableAsset->consumable()->create([
            'qty' => mt_rand(10, 100),
            'lifetime' => fake()->randomDigit()
        ]);
    }
}
