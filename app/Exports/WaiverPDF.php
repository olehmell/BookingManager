<?php

namespace App\Exports;

use App\Queries\Bookings\BookingsArrivingOnThisDate;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class WaiverPDF extends BaseReport implements FromView
{
    public $date;

    public function __construct($date)
    {
        $this->date = $date;
        parent::__construct();
    }

    public function query()
    {
        return (new BookingsArrivingOnThisDate($this->date))->get();
    }

    public function mappedFieldsArray($booking)
    {
        return collect([
          'ref' => $booking->booking_ref,
          'name' => $booking->customer['name'],
          'arrival' => $booking->arrival_date->format('d-m-Y'),
          'time' => $booking->arrivalTime,
          'terminal' => $booking->flight['terminal_out'],
          'return' => $booking->return_date->format('d-m-Y'),
          'return_time' => $booking->returnTime,
          'flight_in' => $booking->flight['flight_in'],
          'vehicle' => $booking->vehicle['make'] ?? $booking->vehicle['model'],
          'vehicle_reg' => $booking->vehicle['registration'],
          'vehicle_colour' => $booking->vehicle['colour'],
          'mobile' => $booking->customer['mobile']
        ]);
    }

    public function view(): View
    {
        return view('reports.waiver-pdf', ['bookings' => $this->collection()]);
    }

    public function type(): string
    {
        return 'waivers_' . $this->date->format('d_m_Y');
    }

    public function fileExtension(): string
    {
        return '.pdf';
    }
}
