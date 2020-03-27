<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingInfoTipsComponentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roaming_info_tips_components', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('parent_id');
            $table->text('body_text_en');
            $table->text('body_text_bn');
            $table->tinyInteger('position')->default(0);
            $table->string('component_type', 100)->comment("photo,table,headline,accordion,list-component");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('roaming_info_tips_components');
    }

}
