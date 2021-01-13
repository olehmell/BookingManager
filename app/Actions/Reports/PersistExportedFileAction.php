<?php


namespace App\Actions\Reports;


use App\Models\GeneratedReports;

class PersistExportedFileAction
{
    public function execute($file, GeneratedReports $report)
    {
        $report->name = $file;

        $path = \Storage::path($file);


    }
}
