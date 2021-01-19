<?php


namespace App\Actions\Reports;


class PersistExportedFileAction
{
    public function execute($report)
    {
        $persistedReport = (new CreateGeneratedReportAction())->execute($report);

        if ($persistedReport) {
            $persistedReport->addMedia(\Storage::path('temp/' . $report->filename))
                ->toMediaCollection('exports');
        }

       return $persistedReport;
    }
}
