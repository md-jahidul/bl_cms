<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnRechargeWinningCappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('own_recharge_winning_cappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('own_recharge_id');
            $table->string('reward_getting_type');
            $table->timestamps();
            $table->foreign('own_recharge_id')
                ->references('id')
                ->on('my_bl_own_recharge_invertories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('own_recharge_winning_cappings');
    }
}
