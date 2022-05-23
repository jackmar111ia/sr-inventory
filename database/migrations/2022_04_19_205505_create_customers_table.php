<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('image',250);
            $table->string('name',250);
            $table->string('email',250);
            $table->string('user_name',250);
            $table->string('phone',50);
            $table->string('account_status_on_wordpress',30);
            $table->string('account_activation_status',10);
            $table->string('send_email_status',10)->default('no');
            $table->dateTime('email_sent_at');
            $table->integer('email_sent_by');
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
        Schema::dropIfExists('customers');
    }
}
