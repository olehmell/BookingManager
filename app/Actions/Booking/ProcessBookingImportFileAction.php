<?php


namespace App\Actions\Booking;


use App\Models\BookingImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class ProcessBookingImportFileAction
{

    protected $importer;

    public function __construct(Excel $excel)
    {
        $this->importer = $excel;
    }

    public function execute(BookingImport $import)
    {
        if (!$import->mapper) {
            throw new \InvalidArgumentException('Cannot import bookings without field mappings');
        }

        $file = $import->getFirstMediaPath('imports');

        $content = $this->importer->import(new \App\Imports\BookingImport($import), $file);

        return $import->refresh();
    }

}
