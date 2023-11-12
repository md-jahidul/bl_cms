<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblSimBarUnbarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_sim_bar_unbar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->unique();
            $table->string('requester_msisdn');
            $table->string('action_msisdn');
            $table->string('current_status')->nullable();
            $table->string('action_status')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->string('user_ip')->nullable();
            $table->string('version')->nullable();
            $table->string('platform')->nullable();
            $table->string('device_token')->nullable();
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
        Schema::dropIfExists('mybl_sim_bar_unbar');
    }
}
