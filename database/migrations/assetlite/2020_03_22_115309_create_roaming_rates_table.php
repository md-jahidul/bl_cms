<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingRatesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roaming_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('region', 200);
            $table->mediumInteger('operator_id');
            $table->decimal('call_rate', 8, 2)->nullable();
            $table->decimal('sms_rate', 8, 2)->nullable();
            $table->decimal('data_rate', 8, 2)->nullable();
            $table->tinyInteger('type')->default(0)->comment("1=prepaid, 2=postpaid");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('roaming_rates');
    }

}
