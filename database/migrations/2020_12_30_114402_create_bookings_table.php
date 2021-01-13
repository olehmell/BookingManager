<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->index();
            $table->foreignId('product_id')->index();
            $table->text('booking_ref');
            $table->dateTime('arrival_date')->index();
            $table->dateTime('return_date')->nullable();
            $table->json('customer');
            $table->json('vehicle')->nullable();
            $table->json('flight')->nullable();
            $table->json('price');
            $table->json('notes')->nullable();
            $table->enum('status', ['booked', 'cancelled', 'no show', 'refunded', 'complaint'])->default('booked');
            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('agents');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
