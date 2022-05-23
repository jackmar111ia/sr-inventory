<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otp_tracks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone',50);

            $table->bigInteger('messageId')->unsigned()->nullable();
            $table->string('msgTxt',50);
            $table->integer('msgSendStatus')->unsigned();

            $table->string('otp',20);
            $table->string('otpStatus',50);
            $table->string('msgType',20);
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
        Schema::dropIfExists('otp_tracks');
    }
}
