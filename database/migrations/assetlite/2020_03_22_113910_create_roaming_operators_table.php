<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingOperatorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roaming_operators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_en', 200)->nullable();
            $table->string('country_bn', 200)->nullable();
            $table->string('operator_en', 300)->nullable();
            $table->string('operator_bn', 300)->nullable();
            $table->string('tap_code', 100)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=show,0=hide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('roaming_operators');
    }

}
