<?php

namespace App\Exports;

use App\Queries\Bookings\BookingsArrivingOnThisDate;
use App\Queries\Bookings\BookingsReturningOnThisDate;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DailySchedule extends BaseReport implements FromCollection, WithTitle, WithCustomStartCell, WithStyles
{
    public $date;

    /**
     * DailySchedule constructor.
     *
     * @param null $date
     */
    public function __construct($date = null)
    {
        $this->date = is_null($date) ? Carbon::today() : $date;

        parent::__construct();
    }

    /**
     * The title used as the label on the first line of the report.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Schedule: ' . $this->date->format('d-m-Y');
    }

    /**
     * Used to gather the collection of bookings required for the report.
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function query()
    {
        return collect([
            $this->arrivals(),
            $this->returns()
        ])->flatten()->sortBy('sort');
    }

    /**
     * The report type which is used for naming the file.
     *
     * @return string
     */
    public function type(): string
    {
        return 'daily_schedule_' . $this->date->format('d_m_Y');
    }

    /**
     * Change the starting cell.
     *
     * @return string
     */
    public function startCell(): string
    {
        return 'A3';
    }

    /**
     * The fields used in the schedule.
     *
     * @param $booking
     * @return \Illuminate\Support\Collection
     */
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

    /**
     * Collection of bookings arriving or 'incoming' on the given date.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function arrivals()
    {
        return (new BookingsArrivingOnThisDate($this->date))->get()->each(function ($booking) {
            return $booking->sort = $booking->arrival_date;
        });
    }

    /**
     * Collection of bookings returning or 'outgoing' on the given date.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function returns()
    {
        return (new BookingsReturningOnThisDate($this->date))->get()->each(function ($booking) {
            return $booking->sort = $booking->return_date;
        });
    }

    /**
     * If the booking is incoming we want the arrivalTime. If the booking is outgoing
     * we want the returnTime.
     *
     * @param $booking
     * @return mixed
     */
    protected function getCorrectTime($booking)
    {
        return $this->date->isSameDay($booking->arrival_date)
            ? $booking->arrivalTime : $booking->returnTime;
    }

    /**
     * Determine whether the booking is 'incoming' or 'outgoing' for the schedule.
     *
     * @param $booking
     * @return string
     */
    protected function getDirectionType($booking): string
    {
        return $this->date->isSameDay($booking->arrival_date) ? 'In' : 'Out';
    }

    /**
     * The styling applied to the sheet.
     *
     * @param Worksheet $sheet
     * @throws Exception
     */
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
}
