<?php


namespace App\Exports;

use App\Traits\WorksWithBookingExports;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

abstract class BaseReport implements WithHeadings, BookingExportReportInterface, ShouldAutoSize
{
    use Exportable;

    public string $type;

    public string $fileExtension;

    public string $filename;

    public $agent;

    public ?Authenticatable $user;

    /**
     * Report constructor.
     *
     */
    public function __construct()
    {
        $this->type = $this->type();
        $this->filename = $this->filename();
        $this->user = \Auth::user();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->map($this->query());
    }

    /**
     * The filename for the export.
     *
     * @return string
     */
    public function filename(): string
    {
        return Str::random(6) . '_' . $this->type . $this->fileExtension();
    }

    /**
     * The file extension string.
     *
     * @return string
     */
    public function fileExtension(): string
    {
        return '.xlsx';
    }

    /**
     * The report type string.
     *
     * @return string
     */
    public function type(): string
    {
        return 'report';
    }

    /**
     * Return a collection after passing through the mapped fields array
     * to ensure only what is required is given to the report collection.
     *
     * @param $collection
     * @return mixed
     */
    public function map($collection)
    {
        return $collection->map(function ($booking) {
            return $this->mappedFieldsArray($booking);
        });
    }

    protected function mappedFieldsArray($booking)
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
