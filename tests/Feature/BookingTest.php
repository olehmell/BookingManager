<?php

namespace Tests\Feature;

use App\Actions\Booking\CreateBookingAction;
use App\Models\Agent;
use App\Models\Bookings\Booking;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_new_booking_can_be_created()
    {
        $booking = Booking::factory()->make()->toArray();
        $this->post(route('bookings.store'), $booking)->assertStatus(201);

        $this->assertDatabaseCount('bookings', 1);
    }

    public function test_a_booking_cannot_be_created_without_customer_data()
    {
        $booking = Booking::factory()->make(['customer' => null])->toArray();

        $this->post(route('bookings.store'), $booking)->assertStatus(302);
    }

    public function test_a_booking_cannot_be_created_without_vehicle_data()
    {
        $booking = Booking::factory()->make(['vehicle' => null])->toArray();

        $this->post(route('bookings.store'), $booking)->assertStatus(302);
    }

    public function test_a_booking_cannot_be_created_without_price_data()
    {
        $booking = Booking::factory()->make(['price' => null])->toArray();

        $this->post(route('bookings.store'), $booking)->assertStatus(302);
    }

    public function test_a_booking_cannot_be_created_without_an_agent_id()
    {
        $booking = Booking::factory()->make(['agent_id' => null])->toArray();

        $this->post(route('bookings.store'), $booking)->assertStatus(302);
    }

    public function test_searching_for_bookings_by_agent()
    {
        $agent = Agent::factory()->create(['name' => 'test']);

        Booking::factory()->count(10)->create(['agent_id' => (int)$agent->id]);
        Booking::factory()->count(10)->create();

        $this->assertDatabaseCount('bookings', 20);

        $bookings = $this->get(route('bookings.index', ['agent' => $agent->id]));

        $this->assertCount(10, $bookings->decodeResponseJson());
    }

    public function test_searching_for_bookings_by_product()
    {
        $product = Product::factory()->create();

        Booking::factory()->count(10)->create(['product_id' => (int)$product->id]);
        Booking::factory()->count(10)->create();

        $this->assertDatabaseCount('bookings', 20);

        $bookings = $this->get(route('bookings.index', ['product' => $product->id]));

        $this->assertCount(10, $bookings->decodeResponseJson());

        $this->assertEquals($product->id, $bookings[0]['product_id']);
    }

    public function test_pricing_data_is_generated_when_booking_is_created()
    {
        // Create a booking instance without list_price and supplier_cost;
        $data = Booking::factory()->make(['price' => ['total' => 50]]);

        $booking = (new CreateBookingAction())->execute($data->toArray());

        // Ensure the price array has all three keys.
        $this->assertArrayHasKey('total', $booking->price);

        $this->assertArrayHasKey('list_price', $booking->price);

        $this->assertArrayHasKey('supplier_cost', $booking->price);
    }

    public function test_ensure_price_data_converted_to_cents()
    {
        $data = Booking::factory()->make(['price' => ['total' => 50]]);

        $booking = (new CreateBookingAction())->execute($data->toArray());

        $this->assertEquals(5000, $booking->price['total']);
    }



}
