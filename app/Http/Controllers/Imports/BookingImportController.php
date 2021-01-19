<?php

namespace App\Http\Controllers\Imports;

use App\Actions\Booking\ProcessBookingImportFileAction;
use App\Actions\Booking\UploadBookingImportFileAction;
use App\Exceptions\ImportFileNotFoundException;
use App\Exceptions\MissingImportMappingException;
use App\Http\Controllers\Controller;
use App\Models\BookingImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookingImportController extends Controller
{
    public function index()
    {
        return BookingImport::all();
    }

    /**
     * @param Request $request
     * @param UploadBookingImportFileAction $action
     * @throws ImportFileNotFoundException
     */
    public function store(Request $request, UploadBookingImportFileAction $action)
    {
        if (! $request->hasFile('file')) {
           throw new ImportFileNotFoundException('A valid file must be provided.');
        }

        return $action->execute($request->all());
    }

    public function update($id, ProcessBookingImportFileAction $action)
    {
        $file = BookingImport::findOrFail($id);

        if (! $file->mapper) {
            throw new MissingImportMappingException('A field mapping was not found.');
        }

        return $action->execute($file);
    }

    public function destroy($id)
    {
        $file = BookingImport::find($id);

        Storage::disk('imports')->delete($file->filename);

        if (Storage::disk('imports')->exists($file->filename)) {
            return false;
        }

        return $file->delete();
    }
}
