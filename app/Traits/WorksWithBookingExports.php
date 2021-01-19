<?php


namespace App\Traits;

trait WorksWithBookingExports
{
    private function mappedFieldsArray($booking)
    {
        return collect([
            'booking_ref' => $booking->booking_ref,
            'name' => $booking->customer['name'],
            'mobile' => $booking->customer['mobile'],
            'terminal_out' => $booking->flight['terminal_out'],
            'flight_out' => $booking->flight['flight_out'],
            'terminal_in' => $booking->flight['terminal_in'],
            'flight_in' => $booking->flight['flight_in'],
            'duration' => $booking->duration,
            'arrival_date' => $booking->arrival_date->format('d-m-Y'),
            'arrival_time' => $booking->arrivalTime,
            'return_date' => $booking->return_date->format('d-m-Y'),
            'return_time' => $booking->returnTime,
            'product' => $booking->product->name,
            'product_id' => $booking->product->id,
            'vehicle_make' => $booking->vehicle['make'] ?? $booking->vehicle['model'],
            'vehicle_reg' => $booking->vehicle['registration'],
            'vehicle_colour' => $booking->vehicle['colour'],
            'paid' => $booking->price['total'],
            'list_price' => $booking->price['list_price'],
            'supplier_cost' => $booking->price['supplier_cost'],
            'status' => $booking->status,
            'created_at' => $booking->created_at->format('d-m-Y H:i'),
            'updated_at' => $booking->updated_at->format('d-m-Y H:i')
        ]);
    }

    public function headings(): array
    {
        $headings = collect();

        foreach ($this->collection()->first() as $index => $item) {
            $headings->push($index);
        }

        return $headings->toArray();
    }


}
