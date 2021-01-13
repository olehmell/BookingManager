<?php


namespace App\Models\Reports;


use App\Exports\BookingExportExcel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BookingExportReport extends Report
{

    /**
     * @param $fromDate
     * @param $toDate
     * @return $this
     */
    public function arrivingBetween($fromDate, $toDate)
    {
        $arrivals = $this->model->arrivingBetween($fromDate, $toDate)->get();

        $this->collection->put('arrivals', $arrivals);

        return $this;
    }

    /**
     * @param $fromDate
     * @param $toDate
     * @return $this
     */
    public function returningBetween($fromDate, $toDate)
    {
        $returns = $this->model->returningBetween($fromDate, $toDate)->get();

        $this->collection->put('returns', $returns);

        return $this;
    }


    public function generate()
    {
        $filename = Str::random(10) . '.xlsx';

         \Excel::store(new BookingExportExcel($this->collection), $filename, 'local');

         $this->saveFile(\Storage::path($filename));

    }

    protected function saveFile($path)
    {

    }

}
