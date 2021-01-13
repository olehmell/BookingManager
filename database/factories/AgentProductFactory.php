<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\AgentProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AgentProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AgentProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::factory()->create();
        $agent = Agent::factory()->create();

        return [
            'name' => $product->name,
            'product_id' => $product->id,
            'agent_id' => $agent->id,
            'agent_product_code' => Str::random(3)
        ];
    }
}
