<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Consumable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consumable>
 */
class ConsumableFactory extends Factory
{
    protected $model = Consumable::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand_id' => Brand::pluck('id')->random(),
            'name' => fake()->randomElement(['laptop', 'komputer', 'meja', 'TV', 'kursi', 'AC', 'Kulkas', 'Lemari', 'Rack', 'Server', 'Motor', 'Mobil', 'Kipas', 'HP', 'Kamera', 'Drone', 'Lighting', 'Tripod']),
            'image' => 'Image.jpg',
            'barcode' => fake()->isbn13(),
            'lifetime' => fake()->randomDigit(),
            'description' => 'Lorem ipsum dolor sit amet',
            'item_price' => fake()->randomNumber(6, true)
        ];
    }
}
