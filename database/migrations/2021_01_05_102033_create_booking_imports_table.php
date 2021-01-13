<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_imports', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('original_file_name');
            $table->string('path')->nullable();
            $table->integer('heading_row')->default(1);
            $table->foreignId('field_mapping_id')->nullable();
            $table->integer('row_count')->nullable()->default(null);
            $table->enum('status', ['pending', 'processing', 'complete', 'failed', 'error'])->default('pending');
            $table->timestamps();

//            $table->foreign('field_mapping_id')->references('id')->on('import_mappings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_imports');
    }
}
