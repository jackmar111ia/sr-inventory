<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moderators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('role')->unsigned()->nullable();

          
            $table->string('email',250)->unique();
            $table->string('password');
            $table->tinyInteger('email_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token',200)->nullable();

            $table->string('nid',250);
            $table->text('present_address');
            $table->text('permanent_address');
            
            $table->string('country_code',20)->default("+88");
            $table->string('phone',20)->nullable();
            $table->string('otp',250);
            $table->tinyInteger('otp_verify_status');
            $table->timestamp('otp_verified_at')->nullable();

          
            $table->string('notiType',15);
            
            $table->string('activity_status',20)->nullable()->default('active')->comment("inactive,active,block");
        
            $table->integer('approvedBy')->nullable()->unsigned();
            $table->dateTime('approval_time')->nullable();

            $table->integer('blockedBy')->nullable()->unsigned();
            $table->dateTime('block_time')->nullable();
            $table->text('block_note')->nullable();

            $table->string('edit_status',20)->default('open');
            $table->dateTime('edit_locked_at');
            $table->string('lastlogin')->nullable();

            $table->text('updated_admin_track')->nullable();


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
        Schema::dropIfExists('moderators');
    }
}
