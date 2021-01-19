<?php

namespace App\Exports;

use App\Queries\Bookings\BookingsReturningOnThisDate;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookingExportByReturnDateExcel extends BaseReport
{
    public $date;

    public function __construct($date)
    {
        parent::__construct();

        $this->date = $date;

    }

    public function query()
    {
       return (new BookingsReturningOnThisDate($this->date))->get();
    }
}
