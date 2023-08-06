<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('profile_image_info')->nullable();
            $table->string('os_type')->nullable();
            $table->string('device_info')->nullable();
            $table->string('first_login_at')->nullable();
            $table->string('last_login_at')->nullable();
            $table->string('platform')->nullable();
            $table->string('app_version')->nullable();
            $table->boolean('is_soft_deleted')->default(0);
            $table->dateTime('soft_deleted_at')->nullable();
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
        Schema::dropIfExists('guest_customer');
    }
}
