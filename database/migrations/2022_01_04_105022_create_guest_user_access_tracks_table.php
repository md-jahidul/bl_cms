<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestUserAccessTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_user_access_tracks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device_id')->nullable()->index();
            $table->string('fcm_token')->nullable();
            $table->string('platform')->nullable();
            $table->string('msisdn')->nullable()->index();
            $table->string('msisdn_entry_type')->nullable();
            $table->string('page_name')->nullable();
            $table->string('failed_reason')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('guest_user_access_tracks');
    }
}
