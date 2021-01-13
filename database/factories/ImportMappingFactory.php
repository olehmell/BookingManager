<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\ImportMapping;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImportMappingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImportMapping::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Default',
            'fields' => $this->mappings()
        ];
    }

    protected function mappings()
    {
        return [
            'product_id' => Product::factory()->create()->id,
            'agent_id' => Agent::factory()->create()->id,
            'booking_ref' => 'BookingRef',
            'customer' => [
                'name' => 'NAME',
                'email' => null,
                'mobile' => 'MOBILE'
            ],
            'vehicle' => [
                'make' => '',
                'model' => 'MODEL',
                'colour' => 'COLOUR',
                'registration' => 'REG',
                'passengers' => 'pass'
            ],
            'flight' => [
                'flight_out' => '',
                'flight_in' => 'FLITENO',
                'terminal_out' => 'TERM',
                'terminal_in' => 'TERM'
            ],
            'arrival_date' => 'DateFrom, Meettime',
            'return_date' => 'ReturnDate, ReturnTime',
            'price' => [
                'total' => 'paid',
                'list_price' => '',
                'supplier_cost' => ''
            ],
            'status' => ''
        ];
    }
}
