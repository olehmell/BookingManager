<?php

namespace Tests\Feature;

use App\Actions\Reports\BookingExportAction;
use App\Exports\BookingExportByReturnDateExcel;
use App\Models\Agent;
use App\Models\Bookings\Booking;
use App\Models\GeneratedReports;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingExportByReturnDateReportTest extends TestCase
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
        $this->bookings = Booking::factory()->count($this->bookingCount)
            ->create([
                'agent_id' => $this->agent->id,
                'product_id' => $this->product->id,
            ]);

        $this->user = User::factory()->create();
    }

    public function test_a_new_instance_of_booking_export_report_can_be_created_and_a_generated_report_model_is_returned()
    {
        $this->actingAs($this->user);

        $report = (new BookingExportAction)->execute(
            new BookingExportByReturnDateExcel(
                $this->bookings->first()->return_date
            )
        );

        $this->assertInstanceOf(GeneratedReports::class, $report);

        $this->assertDatabaseCount('generated_reports', 1);

        $this->assertCount(1, $report->getMedia('exports'));
    }
}
