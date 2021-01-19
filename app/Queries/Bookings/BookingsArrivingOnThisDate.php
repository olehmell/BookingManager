<?php


namespace App\Queries\Bookings;


use App\Models\Bookings\Booking;
use Carbon\Carbon;

class BookingsArrivingOnThisDate
{
    public $start;
    public $end;

    public function __construct($date = null)
    {
        if (! $date) {
            $date = Carbon::now();
        }
        $this->start = Carbon::createFromTimeString($date)->startOfDay();
        $this->end = Carbon::createFromTimeString($date)->endOfDay();
    }

    public function get()
    {
        return Booking::whereBetween('arrival_date', [$this->start, $this->end])->get();
    }


}
