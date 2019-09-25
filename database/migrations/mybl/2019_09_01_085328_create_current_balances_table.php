<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('balance');
            $table->string('validity');
            $table->string('minutes_volume')->nullable();
            $table->string('minutes_validity')->nullable();
            $table->string('sms_volume')->nullable();
            $table->string('sms_validity')->nullable();
            $table->string('internet_volume')->nullable();
            $table->string('internet_validity')->nullable();
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
        Schema::dropIfExists('current_balances');
    }
}
