<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingOtherOfferComponentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roaming_other_offer_component', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('parent_id');
            $table->text('body_text_en');
            $table->text('body_text_bn');
            $table->tinyInteger('position')->default(0);
            $table->string('component_type', 100)->comment("text,table");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('roaming_other_offer_component');
    }

}
