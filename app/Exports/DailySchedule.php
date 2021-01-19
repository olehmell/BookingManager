<?php

namespace App\Exports;

use App\Queries\Bookings\BookingsArrivingOnThisDate;
use App\Queries\Bookings\BookingsReturningOnThisDate;
use Arr;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DailySchedule extends BaseReport implements WithTitle, WithEvents, WithCustomStartCell, WithStyles
{
    use RegistersEventListeners;

    public $date;

    public function __construct($date = null)
    {
        $this->date = is_null($date) ? Carbon::today() : $date;

        parent::__construct();
    }


    public function title(): string
    {
        return 'Schedule: ' . $this->date->format('d-m-Y');
    }

    public function query()
    {
        return collect([
            $this->arrivals(),
            $this->returns()
        ])->flatten()->sortBy('sort');
    }

    public function type(): string
    {
        return 'daily_schedule_' . $this->date->format('d_m_Y');
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function styles(Worksheet $sheet)
    {
        // Set orientation to landscape.
        $sheet->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
            ->setFitToPage(true);

        $sheet->getPageMargins()->setBottom(0)->setFooter(0)->setTop(0)->setLeft(0.2)->setRight(0.2);

        // Label for file
        $sheet->getCell('A1')->setValue($this->title());
        $sheet->getStyle('A')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A1:M1');
        $sheet->mergeCells('A2:M2');

        $headingCellRange = 'A3:M3';

        // Heading row
        $sheet->getStyle($headingCellRange)->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle($headingCellRange)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN);

    }

    protected function mappedFieldsArray($booking)
    {
        return collect([
            'Ref' => $booking->booking_ref,
            'Name' => $booking->customer['name'],
            'Mobile' => $booking->customer['mobile'],
            'Term' => $booking->flight['terminal_in'],
            'Flight' => $booking->flight['flight_in'],
            'Stay' => $booking->duration,
            'Time' => $this->getCorrectTime($booking),
            'Vehicle' => $booking->vehicle['make'] ?? $booking->vehicle['model'],
            'Reg' => $booking->vehicle['registration'],
            'Colour' => $booking->vehicle['colour'],
            'Price' => $booking->price['total'],
            'Prod' => $booking->product->name,
            'Type' => $this->getDirectionType($booking)
        ]);
    }

    protected function arrivals()
    {
        return (new BookingsArrivingOnThisDate($this->date))->get()->each(function ($booking) {
            return $booking->sort = $booking->arrival_date;
        });
    }

    protected function returns()
    {
        return (new BookingsReturningOnThisDate($this->date))->get()->each(function ($booking) {
            return $booking->sort = $booking->return_date;
        });
    }

    protected function getCorrectTime($booking)
    {
        return $this->date->isSameDay($booking->arrival_date)
            ? $booking->arrivalTime : $booking->returnTime;
    }

    protected function getDirectionType($booking)
    {
        return $this->date->isSameDay($booking->arrival_date) ? 'In' : 'Out';
    }
}
