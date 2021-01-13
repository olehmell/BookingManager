<?php


namespace App\Actions\Booking;


use App\Models\BookingImport;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UploadBookingImportFileAction
{
    protected $disk;
    protected $media;

    public function __construct($disk = null)
    {
        $this->disk = $disk ?? BookingImport::STORAGE_DISK;
        $this->media = new Media();
    }

    /**
     * Store uploaded file to disk and create new record in database.
     *
     * @param $request
     * @return mixed
     */
    public function execute($request)
    {
        $uploadedFile = $request['file'];

//        if ($request['file'] instanceof UploadedFile) {
//            $file = $uploadedFile->store('', $this->disk);
//        }


        $import = BookingImport::create([
            'filename' => $uploadedFile->getClientOriginalName(),
            'original_file_name' => $uploadedFile->getClientOriginalName(),
            'heading_row' => $request['heading_row'] ?? 1
        ]);

        $import->addMedia($uploadedFile)
            ->preservingOriginal()
            ->toMediaCollection('imports');

        return $import->refresh()->load('media');

    }

}
