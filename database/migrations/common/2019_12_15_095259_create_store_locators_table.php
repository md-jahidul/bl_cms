<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreLocatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_locators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cc_code')->unique();
            $table->string('cc_name');
            $table->string('district');
            $table->string('thana');
            $table->text('address');
            $table->decimal('longitude', 10, 6);
            $table->decimal('latitude', 10, 6);
            $table->string('opening_time');
            $table->string('closing_time');
            $table->string('holiday')->default('NA');
            $table->string('half_holiday')->default('NA');
            $table->string('half_holiday_opening_time')->nullable();
            $table->string('half_holiday_closing_time')->nullable();
            $table->timestamps();

            $table->index('cc_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_locators');
    }
}
