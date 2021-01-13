<?php

namespace Tests\Feature;

use App\Models\ImportMapping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tests\TestCase;

class ImportMappingTest extends TestCase
{
    use RefreshDatabase;

    public $mappingData;

    public function setUp(): void
    {
        parent::setUp();

        $this->mappingData = ImportMapping::factory()->make()->toArray();
    }

    public function test_a_new_import_mapping_can_be_created()
    {
        $this->post(route('bookings.import.mappings.store'), $this->mappingData)->assertStatus(201);

        $this->assertDatabaseCount('import_mappings', 1);
    }

    public function test_a_new_import_mapping_must_have_mapped_fields()
    {
        $data = ImportMapping::factory()->make(['fields' => null])->toArray();

        $this->post(route('bookings.import.mappings.store'), $data)->assertStatus(302);

        $this->assertDatabaseCount('import_mappings', 0);
    }
}
