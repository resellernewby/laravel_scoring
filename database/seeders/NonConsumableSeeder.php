<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\FundsSource;
use App\Models\Location;
use App\Models\Order;
use App\Models\Suplier;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NonConsumableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asset = Asset::create([
            'suplier_id' => Suplier::pluck('id')->random(),
            'brand_id' => Brand::pluck('id')->random(),
            'barcode' => fake()->isbn13(),
            'name' => fake()->randomElement(['laptop', 'komputer', 'meja', 'TV', 'kursi', 'AC', 'Kulkas', 'Lemari', 'Rack', 'Server', 'Motor', 'Mobil', 'Kipas', 'HP', 'Kamera', 'Drone', 'Lighting', 'Tripod']),
            'type' => 'non-consumable',
            'current_price' => fake()->randomNumber(6, true)
        ]);


        $warehouse = Warehouse::with('racks')->inRandomOrder()->first();
        $asset->warehouses()->attach($warehouse->id);
        $asset->racks()->attach($warehouse->racks->first()->id, ['qty' => 2, 'price' => fake()->randomNumber(6, true)]);

        $order = Order::create([
            'name' => 'CV. Teknik',
            'status' => 'new stock',
            'date' => now(),
            'funds_source_id' => FundsSource::pluck('id')->random()
        ]);

        $asset->transactions()->create([
            'order_id' => $order->id,
            'qty' => 2,
            'price' => fake()->randomNumber(6, true)
        ]);

        $asset->nonConsumables()->createMany([
            [
                'location_id' => Location::pluck('id')->random(),
                'user' => fake()->name(),
                'serial' => fake()->ean13(),
                'economic_age' => fake()->randomDigit(),
                'residual_value' => fake()->randomNumber(5, true),
                'price' => fake()->randomNumber(6, true),
                'condition' => fake()->randomElement(['poor', 'fair', 'good', 'excellent']),
                'current_status' => 'in stock', //fake()->randomElement(['in use', 'in stock', 'damaged']),
                'purchase_date' => fake()->dateTimeThisDecade(),
                'warranty_period' => fake()->randomDigit(),
                'warranty_provider' => 'ABc'
            ],
            [
                'location_id' => Location::pluck('id')->random(),
                'user' => fake()->name(),
                'serial' => fake()->ean13(),
                'economic_age' => fake()->randomDigit(),
                'residual_value' => fake()->randomNumber(5, true),
                'price' => fake()->randomNumber(6, true),
                'condition' => fake()->randomElement(['poor', 'fair', 'good', 'excellent']),
                'current_status' => 'in stock',
                'purchase_date' => fake()->dateTimeThisDecade(),
                'warranty_period' => fake()->randomDigit(),
                'warranty_provider' => 'Cpinc'
            ]
        ]);
    }
}
