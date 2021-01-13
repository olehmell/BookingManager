<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class BookingExportExcel implements FromCollection
{
    protected $bookings;

    public function __construct($bookings)
    {
        $this->bookings = $bookings;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->bookings;
    }
}
