<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('agent_id');
            $table->foreignId('product_id');
            $table->string('agent_product_code');
            $table->integer('commission')->default(25);
            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('agents')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_products');
    }
}
