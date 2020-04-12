<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypeDeviceOffersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('device_offers', function (Blueprint $table) {
            $table->string('brand', 255)->change();
            $table->string('model', 255)->change();
            $table->text('free_data_one')->change();
            $table->text('free_data_two')->change();
            $table->text('free_data_three')->change();
            $table->text('bonus_data_one')->change();
            $table->text('bonus_data_two')->change();
            $table->text('bonus_data_three')->change();
            $table->text('available_shop')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
