<?php


namespace App\Actions\Reports;


use App\Exports\BaseReport;

class BookingExportAction
{

    public function execute(BaseReport $export)
    {
        // We first store the file in a temp directory to ensure the file gets generated
        // by the excel exporter.
        $export->store('/temp/' . $export->filename, 'local');

        // Once the file has been created we proceed to persist to the database by using the file path
        // to add to the 'exports' media collection of either an agent or user model. This will allow us to easily
        // retrieve the file from the storage disk to re-download without needing to re-generate the file from the
        // collection query.
        return (new PersistExportedFileAction())->execute($export);
    }

}
