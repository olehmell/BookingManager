<?php


namespace App\Actions\Reports;


use App;
use App\Exports\BaseReport;

class BookingWaiverAction
{
    public $pdf;

    public function __construct()
    {
        $this->pdf = App::make('dompdf.wrapper');
    }

    public function execute(BaseReport $report)
    {
        // We use a view so we can load html to the pdf file with all the styling
        // and data.
        $this->pdf->loadHtml(
            $report->view())->save(storage_path() . '/app/temp/' . $report->filename
        );

        // Once the file has been created we proceed to persist to the database by using the file path
        // to add to the 'exports' media collection of either an agent or user model. This will allow us to easily
        // retrieve the file from the storage disk to re-download without needing to re-generate the file from the
        // collection query.
        return (new PersistExportedFileAction())->execute($report);
    }

}
