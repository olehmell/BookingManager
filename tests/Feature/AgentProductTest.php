<?php

namespace Tests\Feature;

use App\Models\Agent;
use App\Models\AgentProduct;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AgentProductTest extends TestCase
{
    use RefreshDatabase;

    public $product;
    public $agent;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->product = Product::factory()->create();
        $this->agent = Agent::factory()->create();
    }

    public function test_a_new_agent_product_can_be_created()
    {
        $data = AgentProduct::factory()->make()->toArray();

        $this->post(route('agents.products.store'), $data)->assertStatus(201);

        $this->assertDatabaseCount('agents_products', 1);
    }

    public function test_can_a_new_agent_product_cannot_be_created_without_valid_agent()
    {
        $this->expectException(ValidationException::class);

        $data = AgentProduct::factory()->make(['agent_id' => ''])->toArray();

        $this->post(route('agents.products.store'), $data);

        $this->assertDatabaseCount('agents_products', 0);
    }

    public function test_can_a_new_agent_product_cannot_be_created_without_valid_product()
    {
        $this->expectException(ValidationException::class);

        $data = AgentProduct::factory()->make(['product_id' => ''])->toArray();

        $this->post(route('agents.products.store'), $data);

        $this->assertDatabaseCount('agents_products', 0);
    }
}
