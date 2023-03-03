<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\FundsSource;
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
        $funds_source_id = FundsSource::pluck('id')->random();
        $suplier_id = Suplier::pluck('id')->random();
        $consumableAsset = Asset::create([
            'funds_source_id' => $funds_source_id,
            'suplier_id' => $suplier_id,
            'brand_id' => Brand::pluck('id')->random(),
            'barcode' => fake()->isbn13(),
            'name' => fake()->randomElement(['catridge', 'spidol', 'tissue', 'kertas', 'tinta']),
            'type' => 'consumable',
            'qty' => 24,
            'current_price' => fake()->randomNumber(5, true),
            'purchase_at' => '2023-02-08'
        ]);

        $warehouse = Warehouse::with('racks')->where('id', '<>', 1)->inRandomOrder()->first();
        $consumableAsset->warehouses()->attach($warehouse->id);
        $consumableAsset->racks()->attach($warehouse->racks->first()->id, [
            'qty' => 24
        ]);

        $order = Order::create([
            'name' => 'CV. Rafah',
            'status' => 'new stock',
            'date' => '2023-02-08',
            'funds_source_id' => $funds_source_id,
            'suplier_id' => $suplier_id
        ]);

        $consumableAsset->transactions()->create([
            'order_id' => $order->id,
            'qty' => 24,
            'price' => fake()->randomNumber(6, true)
        ]);

        $consumableAsset->consumable()->create([
            'lifetime' => fake()->randomDigit()
        ]);
    }
}
