<?php

namespace Database\Factories\Bookings;

use App\Models\Agent;
use App\Models\Bookings\Booking;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrival = Carbon::now()->addWeeks($this->faker->randomElement([3, 5, 7, 8, 9, 10, 14, 21]));
        $return = Carbon::parse($arrival)->addDays($this->faker->randomElement([3, 5, 7, 8, 9, 10, 14, 21]));

        return [
            'agent_id' => Agent::factory()->create(),
            'product_id' => Product::factory()->create(),
            'booking_ref' => Str::random(6),
            'arrival_date' => $arrival,
            'return_date' => $return,
            'customer' => $this->customer(),
            'vehicle' => $this->vehicle(),
            'price' => $this->price(),
            'flight' => $this->flight()
        ];
    }

    protected function customer()
    {
        return [
            'name' => $this->faker->firstName .' ' . $this->faker->lastName,
            'email' => $this->faker->email,
            'mobile' => $this->faker->phoneNumber,
        ];
    }

    protected function vehicle()
    {
        return [
            'make' => $this->faker->randomElement(['ford', 'mercedes', 'bmw', 'vw']),
            'model' => $this->faker->word,
            'colour' => $this->faker->colorName,
            'registration' => Str::random(7)
        ];
    }

    protected function price()
    {
        return [
            'total' => 10000,
            'list_price' => 10000,
            'supplier_cost' => 2500,
        ];
    }

    protected function flight()
    {
        return [
            'flight_out' => Str::random(6),
            'flight_in' => Str::random(6),
            'terminal_out' => $this->faker->randomElement([1, 2, 3]),
            'terminal_in' => $this->faker->randomElement([1, 2, 3])
        ];
    }

}
