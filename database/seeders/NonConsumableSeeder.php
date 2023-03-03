<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\FundsSource;
use App\Models\Order;
use App\Models\Rack;
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
            'name' => fake()->randomElement(['laptop', 'komputer', 'meja', 'TV', 'AC', 'Kulkas', 'Lemari', 'Server', 'HP', 'Kamera', 'Drone']),
            'type' => 'non-consumable',
            'qty' => 2,
            'current_price' => 500000,
            'purchase_at' => now()
        ]);


        $warehouse = Warehouse::with('racks')->where('id', '<>', 1)->inRandomOrder()->first();
        $asset->warehouses()->attach($warehouse->id);
        $asset->racks()->attach(2, ['qty' => 2]);

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
                'non_consumable_type' => Rack::class,
                'non_consumable_id' => 2,
                'user' => config('setting.user_beginner'),
                'serial' => fake()->ean13(),
                'economic_age' => fake()->randomDigit(),
                'residual_value' => fake()->randomNumber(5, true),
                'price' => 500000,
                'condition' => 'excellent',
                'current_status' => 'in_stock', //fake()->randomElement(['in_use', 'in_stock', 'damaged']),
                'purchase_date' => fake()->dateTimeThisDecade(),
                'warranty_period' => fake()->randomDigit(),
                'warranty_provider' => 'Distributor'
            ],
            [
                'non_consumable_type' => Rack::class,
                'non_consumable_id' => 2,
                'user' => config('setting.user_beginner'),
                'serial' => fake()->ean13(),
                'economic_age' => fake()->randomDigit(),
                'residual_value' => fake()->randomNumber(5, true),
                'price' => 500000,
                'condition' => 'excellent',
                'current_status' => 'in_stock',
                'purchase_date' => fake()->dateTimeThisDecade(),
                'warranty_period' => fake()->randomDigit(),
                'warranty_provider' => 'Distributor'
            ]
        ]);
    }
}
