<?php


namespace App\Queries\Bookings;


use App\Models\Bookings\Booking;
use Carbon\Carbon;

class BookingsCollection
{

    /**
     * Return a collection of all bookings in the database.
     *
     * @return Booking[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        return Booking::all();
    }

    /**
     * Return a collection of bookings by status.
     *
     * @param $status
     * @return \Illuminate\Support\Collection
     */
    public function getByStatus($status)
    {
        return Booking::where('status', $status)->get();
    }


}
