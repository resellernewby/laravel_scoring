<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\StatusAsset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand_id' => Brand::pluck('id')->random(),
            'status_asset_id' => StatusAsset::pluck('id')->random(),
            'name' => fake()->randomElement(['laptop', 'komputer', 'meja', 'TV', 'kursi', 'AC', 'Kulkas', 'Lemari', 'Rack', 'Server', 'Motor', 'Mobil', 'Kipas', 'HP', 'Kamera', 'Drone', 'Lighting', 'Tripod']),
            'image' => 'Image.jpg',
            'serial' => fake()->ean13(),
            'barcode' => fake()->isbn13(),
            'purchase_cost' => fake()->randomNumber(6, true),
            'lifetime' => fake()->randomDigit(),
            'description' => 'Lorem ipsum dolor sit amet',
            'warranty_period' => fake()->dateTimeBetween('-1 year', '+5 years'),
            'purchase_at' => fake()->dateTimeThisDecade()
        ];
    }
}
