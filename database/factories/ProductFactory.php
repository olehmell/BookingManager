<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'product_code' => Str::random(4),
            'type_id' => ProductType::factory()->create([
                'name' => $this->faker->randomElement([
                    'Meet and Greet', 'Park and Ride'
                ])
            ])->id
        ];
    }
}
