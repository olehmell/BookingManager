<?php

namespace Database\Seeders;

use App\Models\Bookings\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::create(['name' => 'Meet and Greet']);
        ProductType::create(['name' => 'Park and Ride']);
    }
}
