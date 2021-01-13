<?php

namespace Tests\Unit;

use App\Actions\Booking\CreateBookingAction;
use App\Models\Agent;
use App\Models\AgentProduct;
use App\Models\Booking;
use App\Models\Product;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AgentTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_agent_can_be_created()
    {
        $agent = Agent::factory()->make()->toArray();

        $this->post(route('agents.store', $agent))->assertStatus(201);

        $this->assertCount(1, Agent::all());
    }

    public function test_an_agent_cannot_be_created_with_a_duplicate_name()
    {
        $agent = Agent::factory()->make(['name' => 'test'])->toArray();

        $this->post(route('agents.store', $agent))->assertStatus(201);

        $this->post(route('agents.store', $agent))->assertStatus(302);

        $this->assertCount(1, Agent::all());
    }

    public function test_an_agent_can_be_updated()
    {
        $agent = Agent::factory()->create();

        $this->patch(route('agents.update', $agent->id), ['name' => 'updated'])->assertStatus(200);

        $this->assertEquals('updated', Agent::find($agent->id)->name);
    }

    public function test_all_agents_can_be_listed()
    {
        Agent::factory()->count(5)->create();

        $this->get(route('agents.index'))->assertJsonCount(5);
    }

    public function test_an_agent_can_be_deleted()
    {
        $agent = Agent::factory()->create();

        $this->delete(route('agents.destroy', $agent->id))->assertStatus(200);

        $this->assertEmpty(Agent::all());
    }

    public function test_an_agents_revenue_can_be_seen_for_all_associated_products()
    {
        $agent = Agent::factory()->create();

       Product::factory()->count(2)->create();

        AgentProduct::factory()
            ->create([
                'product_id' => 1,
                'agent_id' => $agent->id,
                'agent_product_code' => Str::random(3)
            ]);
        AgentProduct::factory()
            ->create([
                'product_id' => 2,
                'agent_id' => $agent->id,
                'agent_product_code' => Str::random(3)
            ]);


        $this->assertCount(2, $agent->products);

        Booking::factory()
            ->create([
                'agent_id' => $agent->id,
                'product_id' => $agent->products[0]->product_id,
                'price' => ['total' => 50]
            ]);
        Booking::factory()
            ->create([
                'agent_id' => $agent->id,
                'product_id' => $agent->products[1]->product_id,
                'price' => ['total' => 50]
            ]);


        $this->assertEquals(100, $agent->revenue());
    }

    public function test_an_agents_revenue_can_be_filtered_by_product()
    {
        $agent = Agent::factory()->create();

        Product::factory()->count(2)->create();

        AgentProduct::factory()
            ->create([
                'product_id' => 1,
                'agent_id' => $agent->id,
                'agent_product_code' => Str::random(3)
            ]);
        AgentProduct::factory()
            ->create([
                'product_id' => 2,
                'agent_id' => $agent->id,
                'agent_product_code' => Str::random(3)
            ]);

        $this->assertCount(2, $agent->products);

        $bookingOneData = Booking::factory()
            ->make([
                'agent_id' => $agent->id,
                'product_id' => $agent->products[0]->product_id,
                'price' => ['total' => 50]
            ])->toArray();

        $bookingOne = (new CreateBookingAction())->execute($bookingOneData);

        $bookingTwoData = Booking::factory()
            ->make([
                'agent_id' => $agent->id,
                'product_id' => $agent->products[1]->product_id,
                'price' => ['total' => 50]
            ])->toArray();

        $bookingTwo = (new CreateBookingAction())->execute($bookingTwoData);

        $this->assertEquals(5000, $agent->revenueByProduct($bookingOne->product->id));

        $this->assertEquals(5000, $agent->revenueByProduct($bookingTwo->product->id));
    }

    public function test_an_agents_profit_can_be_calculated()
    {
        $agent = Agent::factory()->create();

        Product::factory()->create();

        AgentProduct::factory()
            ->create([
                'product_id' => 1,
                'agent_id' => $agent->id,
                'agent_product_code' => Str::random(3)
            ]);

        $bookingOneData = Booking::factory()
            ->make([
                'agent_id' => $agent->id,
                'product_id' => $agent->products[0]->product_id,
                'price' => ['total' => 50]
            ])->toArray();

        $bokingOne = (new CreateBookingAction())->execute($bookingOneData);

        // This calculation is based on the default commission level of 25%
        $this->assertEquals(5000, $agent->revenue());

        $this->assertEquals(1250, $agent->supplierCost());

        $this->assertEquals(3750, $agent->profit());
    }
}
