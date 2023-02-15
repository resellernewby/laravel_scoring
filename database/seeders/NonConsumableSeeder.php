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
        $funds_source_id = FundsSource::pluck('id')->random();
        $suplier_id = Suplier::pluck('id')->random();
        $asset = Asset::create([
            'funds_source_id' => $funds_source_id,
            'suplier_id' => $suplier_id,
            'brand_id' => Brand::pluck('id')->random(),
            'barcode' => fake()->isbn13(),
            'model' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'name' => fake()->randomElement(['laptop', 'komputer', 'meja', 'TV', 'kursi', 'AC', 'Kulkas', 'Lemari', 'Rack', 'Server', 'Motor', 'Mobil', 'Kipas', 'HP', 'Kamera', 'Drone', 'Lighting', 'Tripod']),
            'type' => 'non-consumable',
            'current_price' => 500000,
            'purchase_at' => now()
        ]);


        $warehouse = Warehouse::with('racks')->inRandomOrder()->first();
        $asset->warehouses()->attach($warehouse->id);
        $asset->racks()->attach($warehouse->racks->first()->id, ['qty' => 2]);

        $order = Order::create([
            'name' => 'CV. Teknik',
            'status' => 'new stock',
            'date' => now(),
            'funds_source_id' => $funds_source_id,
            'suplier_id' => $suplier_id
        ]);

        $asset->transactions()->create([
            'order_id' => $order->id,
            'qty' => 2,
            'price' => 500000
        ]);

        $asset->nonConsumables()->createMany([
            [
                'location_id' => Location::pluck('id')->random(),
                'user' => fake()->name(),
                'serial' => fake()->ean13(),
                'economic_age' => fake()->randomDigit(),
                'residual_value' => fake()->randomNumber(5, true),
                'price' => 500000,
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
                'price' => 500000,
                'condition' => fake()->randomElement(['poor', 'fair', 'good', 'excellent']),
                'current_status' => 'in stock',
                'purchase_date' => fake()->dateTimeThisDecade(),
                'warranty_period' => fake()->randomDigit(),
                'warranty_provider' => 'Cpinc'
            ]
        ]);
    }
}
