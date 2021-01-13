<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('fields')->nullable();
            $table->timestamps();
        });

        Schema::table('booking_imports', function (Blueprint $table) {
            $table->foreign('field_mapping_id')->references('id')->on('import_mappings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_mappings');
    }
}
