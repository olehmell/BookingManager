<?php

namespace App\Exports;

use App\Queries\Bookings\BookingsArrivingOnThisDate;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookingExportByArrivalDateExcel extends BaseReport implements FromCollection
{
    public $date;

    public function __construct($date)
    {
        parent::__construct();

        $this->date = $date;

    }

    public function type(): string
    {
        return 'booking_arrivals_export';
    }

    public function query()
    {
        return (new BookingsArrivingOnThisDate($this->date))->get();
    }
}
