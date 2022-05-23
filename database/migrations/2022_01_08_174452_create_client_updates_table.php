<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('client_id')->nullable()->unsigned();
            $table->string('name');

            $table->string('email',250)->nullable();
            $table->tinyInteger('email_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token',200)->nullable();
            $table->string('email_change_alert',20)->nullable()->default('yes');
             
            $table->date('date_of_deed');
            $table->string('nid',250);
            $table->string('apartment_id',250);
            $table->text('present_address');
            $table->text('permanent_address');
            $table->string('phone',20)->nullable();
            $table->string('otp',250);
            $table->tinyInteger('otp_verify_status');
            $table->timestamp('otp_verified_at')->nullable();
            $table->string('edit_type',20)->default('general')->comment("general,notiType");
            $table->string('status',20);
            $table->text('note')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->string('approval_user_type',30)->nullable();
            $table->text('approval_note')->nullable();
            $table->dateTime('approved_at')->nullable();	
            $table->bigInteger('approved_by')->nullable()->unsigned();
 
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
        Schema::dropIfExists('client_updates');
    }
}
