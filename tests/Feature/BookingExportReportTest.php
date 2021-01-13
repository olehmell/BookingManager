<?php

namespace Tests\Feature;

use App\Models\Agent;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Reports\BookingExportReport;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingExportReportTest extends TestCase
{
    use RefreshDatabase;

    public $agent;
    public $product;
    public $bookings;
    public $bookingCount = 10;

    public function setUp(): void
    {
        parent::setUp();

        $this->agent = Agent::factory()->create();
        $this->product = Product::factory()->create();
        $this->bookings = Booking::factory()->count($this->bookingCount)
            ->create([
                'agent_id' => $this->agent->id,
                'product_id' => $this->product->id
            ]);
    }

    public function test_a_new_instance_of_booking_export_report_can_be_created()
    {
        $report = new BookingExportReport(new Booking);

        $date = Carbon::today();
        $toDate = Carbon::today()->addMonths(3);

        $report->arrivingBetween($date, $toDate);
        $report->returningBetween($date, $toDate);

        dd($report->generate());
    }
}
