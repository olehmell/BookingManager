<?php

namespace Tests\Feature;

use App\Exceptions\ImportFileNotFoundException;
use App\Exceptions\MissingImportMappingException;
use App\Models\Agent;
use App\Models\Booking;
use App\Models\BookingImport;
use App\Models\ImportMapping;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImportBookingTest extends TestCase
{
    use RefreshDatabase;

    public $storage;
    public $user;
    public $fakeFile;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('imports');

        $this->withoutExceptionHandling();

        $this->storage = Storage::disk('imports');
        $this->user = User::factory()->create();
        $this->fakeFile = UploadedFile::fake()->create('filename.xlsx');
    }

    public function test_files_can_be_uploaded()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('bookings.import.store'), ['file' => $this->fakeFile])
            ->assertStatus(201);

        $this->storage->assertExists('/1/' . $this->fakeFile->name);
    }

    public function test_a_booking_import_record_has_been_created_and_the_file_exists()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('bookings.import.store'), ['file' => $this->fakeFile])
            ->assertStatus(201);

        $this->storage->assertExists('/1/' . $this->fakeFile->name);

        $this->assertDatabaseCount('booking_imports', 1);
    }

    public function test_a_valid_file_must_be_provided_when_attempting_to_upload()
    {
        $this->expectException(ImportFileNotFoundException::class);

        $this->actingAs($this->user)->post(route('bookings.import.store'), [])->decodeResponseJson();
    }

    public function test_a_file_cannot_be_processed_without_an_import_mapping_assigned()
    {
        $file = $this->storage->put('', $this->fakeFile);

        $this->storage->assertExists($this->fakeFile->hashName());

        $import = BookingImport::factory()->create([
            'filename' => $this->fakeFile->getClientOriginalName(),
            'original_file_name' => $this->fakeFile->getClientOriginalName(),
        ]);

        $this->assertDatabaseCount('booking_imports', 1);

        $this->expectException(MissingImportMappingException::class);

        $this->patch(route('bookings.import.process', $import->id))->decodeResponseJson();
    }

    public function test_bookings_can_be_imported_from_the_uploaded_file()
    {
        $this->withoutExceptionHandling();

        $path = base_path('tests/data/test-data.xlsx');

        $file = new UploadedFile($path, 'test-data.xlsx', null, null, true);

        $this->post(route('bookings.import.store'), ['file' => $file, 'heading_row' => 2])->assertStatus(201);

        $import = BookingImport::find(1);

        $import->update([
            'field_mapping_id' => ImportMapping::factory()->create()->id
        ]);

        $this->patch(route('bookings.import.process', 1));

        $this->assertDatabaseCount('bookings', $import->refresh()->row_count);
    }

    public function test_bookings_can_be_imported_using_a_different_import_mapping_fieldset()
    {
        $this->withoutExceptionHandling();

        $path = base_path('tests/data/more-test-data.xlsx');

        $file = new UploadedFile($path, 'more-test-data.xlsx', null, null, true);

        $this->post(route('bookings.import.store'), ['file' => $file]);

        Product::factory()->create();

        $import = BookingImport::find(1);

        // We are matching the product_id provided in the file which will match the id of 1.
        $import->update([
            'field_mapping_id' => ImportMapping::factory()->create([
                'fields' => [
                    'product_id' => 'product_id',
                    'agent_id' => Agent::factory()->create()->id,
                    'booking_ref' => 'ref',
                    'customer' => [
                        'name' => 'customer_name',
                        'email' => null,
                        'mobile' => 'mobile'
                    ],
                    'vehicle' => [
                        'make' => '',
                        'model' => 'vehicle_model',
                        'colour' => '',
                        'registration' => 'vehicle_reg',
                        'passengers' => 'passengers'
                    ],
                    'flight' => [
                        'flight_out' => '',
                        'flight_in' => 'flight_in',
                        'terminal_out' => 'terminal',
                        'terminal_in' => 'terminal'
                    ],
                    'arrival_date' => 'arrival_date, arrival_time',
                    'return_date' => 'return_date, return_time',
                    'price' => [
                        'total' => 'paid',
                        'list_price' => '',
                        'supplier_cost' => ''
                    ],
                    'status' => ''
                ]
            ])->id
        ]);

        $this->patch(route('bookings.import.process', 1));

        $this->assertDatabaseCount('bookings', $import->refresh()->row_count);
    }

}
