<?php


namespace App\Actions\Booking;


use App\Models\Bookings\Agent;
use App\Models\Bookings\Booking;
use App\Models\Bookings\Product;
use Carbon\Carbon;
use function Symfony\Component\Translation\t;

class CreateBookingAction
{
    public $data;
    public $booking;

    public function __construct()
    {
        $this->booking = new Booking();
    }

    public function execute($request)
    {
        // Check if a booking already exists with the booking reference.
        if (Booking::byReference($request['booking_ref'])->exists()) {
            $this->booking = Booking::byReference($request['booking_ref'])->first();
        }
        $this->data = $request;

        $this->prepareData();

        $this->booking->fill(collect($this->data)->toArray());

        $this->booking->save();

        return $this->booking->refresh();
    }

    protected function prepareData()
    {
        if (!isset($this->data['status']) || $this->data['status'] === '') {
            unset($this->data['status']);
        }

        $this->checkPricingArray();
    }

    protected function checkPricingArray()
    {
        if (!isset($this->data['price']['total'])) {
            $this->data['price']['total'] = 0;
        }
        if (!isset($this->data['price']['list_price']) || ! $this->data['price']['list_price']) {
            $this->data['price']['list_price'] = (float)$this->data['price']['total'];

        }

        if (!isset($this->data['price']['supplier_cost']) || ! $this->data['price']['supplier_cost']) {
            $this->data['price']['supplier_cost'] = $this->calculateSupplierCost();
        }

        $this->convertPriceToCents();
    }

    protected function calculateSupplierCost(): float
    {
        return (float)$this->data['price']['list_price']
            - $this->data['price']['list_price'] / 100 * config('parkright.commission.default');
    }

    protected function convertPriceToCents()
    {
        foreach ($this->data['price'] as $index => $item) {
            $this->data['price'][$index] = (float)$item * 100;
        }
    }

    protected function getDate($date): Carbon
    {
        return Carbon::createFromFormat('d/m/Y H:i', $date);
    }
}
