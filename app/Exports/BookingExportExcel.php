<?php

namespace App\Exports;

use App\Queries\Bookings\BookingsCollection;
use Maatwebsite\Excel\Concerns\FromCollection;


class BookingExportExcel extends BaseReport implements FromCollection
{
    /**
     * @return \App\Models\Bookings\Booking[]|\Illuminate\Database\Eloquent\Collection
     */
    public function query()
    {
      return (new BookingsCollection())->get();
    }

    public function type():string
    {
        return 'booking_export';
    }
}
