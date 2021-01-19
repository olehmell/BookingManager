<?php


namespace App\Exports;


interface BookingExportReportInterface
{
    /**
     * The query for retrieving the data used to create
     * the report.
     *
     * @return mixed
     */
    public function query();
}
