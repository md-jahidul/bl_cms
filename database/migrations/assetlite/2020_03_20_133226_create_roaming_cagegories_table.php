<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingCagegoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roaming_cagegories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en', 200)->nullable();
            $table->string('name_bn', 300)->nullable();
            $table->string('banner_web', 300)->nullable();
            $table->string('banner_mobile', 300)->nullable();
            $table->string('alt_text', 200)->nullable();
            $table->tinyInteger('status')->default(1)->comment("1=active,0=inactive");
            $table->tinyInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('roaming_cagegories');
    }

}
