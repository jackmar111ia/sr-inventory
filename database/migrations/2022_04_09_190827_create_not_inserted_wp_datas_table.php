<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotInsertedWpDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('not_inserted_wp_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wp_id')->unsigned();
            $table->string('title',250);
            $table->string('permalink',250);
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
        Schema::dropIfExists('not_inserted_wp_datas');
    }
}
