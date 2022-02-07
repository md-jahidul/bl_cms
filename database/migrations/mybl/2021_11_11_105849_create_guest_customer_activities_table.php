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
            $table->string('last_activity')->index();
            $table->dateTime('last_login_at')->nullable();
            $table->dateTime('last_logout_at')->nullable();
            $table->string('device_type')->index();
            $table->string('number_type')->nullable()->index();
            $table->boolean('login_status')->default(0);
            $table->boolean('is_notified')->default(0)->index();
            $table->string('msisdn_entry_type')->nullable()->index();
            $table->string('page_name')->nullable();
            $table->string('failed_reason')->nullable();
            $table->boolean('page_access_status')->nullable()->index();
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
