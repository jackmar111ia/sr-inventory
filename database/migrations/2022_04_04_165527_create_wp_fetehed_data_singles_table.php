<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpFetehedDataSinglesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wp_fetehed_data_singles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wp_id')->unsigned();
            $table->string('title',250);
            $table->string('permalink',250);
            $table->string('image',250);
            $table->text('short_des');
            $table->string('sku',50);
            $table->string('type',50);
            $table->text('variable_product_price');
            $table->float('regular_price');
            $table->float('canada_price');
            $table->float('ontario_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wp_fetehed_data_singles');
    }
}
