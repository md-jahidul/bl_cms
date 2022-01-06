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
            $table->string('device_id')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('platform')->nullable();
            $table->string('page_name')->nullable();
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
