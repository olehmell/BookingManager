<?php

namespace App\Imports;

use App\Actions\Booking\CreateBookingAction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeImport;

class BookingImport implements ToCollection, WithHeadingRow
{
    use Importable, RegistersEventListeners;

    public $import;
    public $headingRow;
    public $mappings;
    public $count;

    public function __construct(\App\Models\BookingImport $import)
    {
        $this->import = $import;

        $this->headingRow = $import->heading_row;

        $this->mappings = $import->mapper->fields;
    }

    /**
     * @param Collection $rows
     * @throws \Exception
     */
    public function collection(Collection $rows)
    {
//        dd($this->mappings['booking_ref']);
        // We only want unique entries to avoid duplication.
        // This will need to be looked at to make more flexible in future update.
        $collection = $rows->unique(strtolower($this->mappings['booking_ref']));

        foreach ($collection as $row) {

            $importObject = (new BookingImportObject($row))->withMappings($this->mappings);

            (new CreateBookingAction())->execute($importObject->toArray());

            $this->count++;
        }
        $this->import->update(['row_count' => $this->count, 'status' => 'complete']);
    }


    public function headingRow()
    {
        return $this->headingRow;
    }
}
