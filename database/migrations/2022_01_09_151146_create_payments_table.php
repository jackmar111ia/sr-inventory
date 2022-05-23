<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('client_id')->nullable()->unsigned();
            $table->string('apartment_id',250)->nullable();

            $table->string('year',250)->nullable();
            $table->string('month',250)->nullable();
            $table->float('amount');
            $table->date('pay_date');
            $table->string('send_status',20)->default('pending');
            $table->dateTime('sent_time');
            $table->string('edit_option',20)->default('open');
            $table->text('note_user')->nullable();

            $table->string('approval_status',20)->default('pending');
            $table->string('approve_update_user',30)->nullable();
            $table->bigInteger('approved_by')->nullable()->unsigned();
            $table->dateTime('approved_time');
            $table->text('note_approved_user')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
