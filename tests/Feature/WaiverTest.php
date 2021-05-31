<?php

namespace Tests\Feature;

use App;
use App\Actions\Reports\BookingWaiverAction;
use App\Exports\WaiverPDF;
use App\Models\Agent;
use App\Models\Bookings\Booking;
use App\Models\GeneratedReports;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WaiverTest extends TestCase
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

        $this->bookings = Booking::all();

        $this->user = User::factory()->create();
    }

    public function test_a_schedule_can_be_generated_and_correctly_formatted_and_sorted()
    {
        $this->actingAs($this->user);

        $report = (new BookingWaiverAction())->execute(
            new WaiverPDF(
                Carbon::today()->addMonth()
            )
        );

        $this->assertInstanceOf(GeneratedReports::class, $report);

        $this->assertDatabaseCount('generated_reports', 1);

        $this->assertCount(1, $report->getMedia('exports'));
    }
}
