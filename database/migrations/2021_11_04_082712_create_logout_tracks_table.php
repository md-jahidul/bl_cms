<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogoutTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logout_tracks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->index();
            $table->timestamp('last_logout_at')->nullable()->index();
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
        Schema::dropIfExists('logout_tracks');
    }
}
