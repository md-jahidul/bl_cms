<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingInfoTipsCategoryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roaming_info_tips_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en', 200)->nullable();
            $table->string('name_bn', 200)->nullable();
            $table->tinyInteger('sort')->default(0);
            $table->tinyInteger('status')->comment("1=show,0=hide");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('roaming_info_tips_category');
    }

}
