<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestCustomerActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_customer_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device_id')->index();
            $table->string('fcm_token')->index();
            $table->string('msisdn')->nullable();
            $table->string('type')->index();
            $table->dateTime('last_login_at')->nullable();
            $table->dateTime('last_logout_at')->nullable();
            $table->boolean('login_status')->default(0);
            $table->boolean('is_notified')->default(0)->index();
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
        Schema::dropIfExists('guest_customer_activities');
    }
}
