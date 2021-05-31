<?php

namespace Tests\Feature;

use App\Actions\Reports\BookingExportAction;
use App\Exports\DailySchedule;
use App\Models\Agent;
use App\Models\Bookings\Booking;
use App\Models\GeneratedReports;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DailyBookingScheduleTest extends TestCase
{
    use RefreshDatabase;

    public $agent;
    public $product;
    public $bookings;
    public $bookingCount = 10;
    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->agent = Agent::factory()->create();
        $this->product = Product::factory()->create();


        // Arrivals
        Booking::factory()
            ->create([
                'agent_id' => $this->agent->id,
                'product_id' => $this->product->id,
                'arrival_date' => Carbon::now()->subMinutes(rand(1, 59))->addMonth(),
                'return_date' => Carbon::now()->subMinutes(rand(1, 59))->addMonth()->addWeek()
            ]);
        Booking::factory()
            ->create([
                'agent_id' => $this->agent->id,
                'product_id' => $this->product->id,
                'arrival_date' => Carbon::now()->subMinutes(rand(1, 59))->addMonth(),
                'return_date' => Carbon::now()->subMinutes(rand(1, 59))->addMonth()->addWeek()
            ]);
        Booking::factory()
            ->create([
                'agent_id' => $this->agent->id,
                'product_id' => $this->product->id,
                'arrival_date' => Carbon::now()->subMinutes(rand(1, 59))->addMonth(),
                'return_date' => Carbon::now()->subMinutes(rand(1, 59))->addMonth()->addWeek()
            ]);

        // Returns
        Booking::factory()
            ->create([
                'agent_id' => $this->agent->id,
                'product_id' => $this->product->id,
                'arrival_date' => Carbon::now()->subWeek()->subMinutes(rand(1, 59))->addMonth(),
                'return_date' =>Carbon::now()->subMinutes(rand(1, 59))->addMonth(),
            ]);
        Booking::factory()
            ->create([
                'agent_id' => $this->agent->id,
                'product_id' => $this->product->id,
                'arrival_date' => Carbon::now()->subWeek()->subMinutes(rand(1, 59))->addMonth(),
                'return_date' =>Carbon::now()->subMinutes(rand(1, 59))->addMonth(),
            ]);
        Booking::factory()
            ->create([
                'agent_id' => $this->agent->id,
                'product_id' => $this->product->id,
                'arrival_date' => Carbon::now()->subWeek()->subMinutes(rand(1, 59))->addMonth(),
                'return_date' =>Carbon::now()->subMinutes(rand(1, 59))->addMonth(),
            ]);


        $this->bookings = Booking::all();

        $this->user = User::factory()->create();
    }

    public function test_a_schedule_can_be_generated_and_correctly_formatted_and_sorted()
    {
        $this->actingAs($this->user);

        $report = (new BookingExportAction)->execute(
            new DailySchedule(
                Carbon::today()->addMonth()
            )
        );

        $this->assertInstanceOf(GeneratedReports::class, $report);

        $this->assertDatabaseCount('generated_reports', 1);

        $this->assertCount(1, $report->getMedia('exports'));
    }
}
