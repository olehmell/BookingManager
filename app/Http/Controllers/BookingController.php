<?php

namespace App\Http\Controllers;

use App\Actions\Booking\CreateBookingAction;
use App\Http\Requests\CreateBookingRequest;
use App\Models\Bookings\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        if (\request()->has('agent')) {
            return Booking::byAgentId(request('agent'))->get();
        }

        if (\request()->has('product')) {
            return Booking::byProduct(request('product'))->get();
        }
        return Booking::all();
    }

    public function show($id)
    {
        return Booking::findOrFail($id);
    }

    public function store(CreateBookingRequest $request, CreateBookingAction $action)
    {
        return $action->execute($request->all());
    }

    public function update(Request $request, $id)
    {

    }

}
