<?php


namespace App\Actions\Reports;


use App\Models\GeneratedReports;

class CreateGeneratedReportAction
{
    public function execute($report)
    {
        $persistedReport = new GeneratedReports();

        $persistedReport->name = $report->filename;
        $persistedReport->user_id = $report->user->id;
        $persistedReport->type = $report->type;

        if ($report->agent) {
            $persistedReport->agent_id = $report->agent->id;
        }

        return tap($persistedReport)->save();
    }
}
