<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
            Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->string('name',250);
            $table->string('user_name',250);

            $table->string('email',250)->nullable()->unique();
            $table->string('email_verification_token',200)->nullable();
            $table->tinyInteger('email_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();

            $table->string('country_code',20)->default("+88");
            $table->string('phone',250)->unique();
           
            $table->string('password');
            $table->string('ustatus',20)->default('pending');
            $table->dateTime('user_activation_time');

            $table->string('lastlogin')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
