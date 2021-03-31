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
            $table->id();
            $table->string('image');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth');
            $table->Float('weight');
            $table->Float('height');
            $table->string('blood');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->index()->default('1');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            
            $table->unsignedBigInteger('activity_id')->index()->default('1');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');

            $table->unsignedBigInteger('gender_id')->index()->default('1');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
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
