<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingOtherOfferTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roaming_other_offer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name_en', 200)->nullable();
            $table->string('name_bn', 200)->nullable();
            $table->string('card_text_en', 300)->nullable();
            $table->string('card_text_bn', 300)->nullable();
            $table->string('short_text_en', 300)->nullable();
            $table->string('short_text_bn', 300)->nullable();
            $table->text('details_en')->nullable();
            $table->text('details_bn')->nullable();
            $table->string('banner_name', 200)->nullable();
            $table->string('banner_web', 300)->nullable();
            $table->string('banner_mobile', 300)->nullable();
            $table->string('alt_text', 200)->nullable();
            $table->string('url_slug', 200)->nullable();
            $table->text('page_header')->nullable();
            $table->text('schema_markup')->nullable();
            $table->mediumInteger('likes')->default(0);
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
        Schema::dropIfExists('roaming_other_offer');
    }

}
