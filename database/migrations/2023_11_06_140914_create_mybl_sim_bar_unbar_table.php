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
            $table->string('current_status');
            $table->string('action_status');
            $table->string('status');
            $table->dateTime('expires_at');
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
