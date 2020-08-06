<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand', 30)->nullable();
            $table->string('model', 30)->nullable();
            $table->string('free_data_one', 200)->nullable();
            $table->string('free_data_two', 200)->nullable();
            $table->string('free_data_three', 200)->nullable();
            $table->string('bonus_data_one', 200)->nullable();
            $table->string('bonus_data_two', 200)->nullable();
            $table->string('bonus_data_three', 200)->nullable();
            $table->string('available_shop', 200)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Show,0=Hide');
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
        Schema::dropIfExists('device_offers');
    }
}
