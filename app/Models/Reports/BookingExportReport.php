<?php


namespace App\Models\Reports;


use App\Actions\Reports\PersistExportedFileAction;
use App\Exports\BookingExportExcel;
use App\Queries\Bookings\BookingsArrivingOnThisDate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BookingExportReport extends Report
{
    public $date;

    public function __construct($date = null)
    {
        parent::__construct();

        $this->date = $date ? Carbon::parse($date) : Carbon::now();
    }

    public function collection()
    {
        return (new BookingsArrivingOnThisDate($this->date))->get();
    }

    public function generate()
    {
        $this->collection = $this->collection();

        return $this->saveFile();
    }

    protected function saveFile()
    {

        // Temporarily store newly created file in 'temp' folder in local storage disk.
        \Excel::store(new BookingExportExcel($this->collection), '/temp/' . $this->filename, 'local');

        // Call action to create a generated report model and attach this file as a media object.
        // This will then move the file to the appropriate folder on the 'exports' disk so that
        // we are able to filter exports based by a user or an agent.
        return (new PersistExportedFileAction())->execute($this);
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return 'booking_export';
    }



}
