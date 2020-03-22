<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingGeneralPagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roaming_general_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_en', 300)->nullable();
            $table->string('title_bn', 300)->nullable();
            $table->string('short_text_en', 500)->nullable()->comment("optional column");
            $table->string('short_text_bn', 500)->nullable()->comment("optional column");
            $table->text('sub_headline_en')->nullable()->comment("multiple in json format");
            $table->text('sub_headline_bn')->nullable()->comment("multiple in json format");
            $table->text('body_text_en')->nullable()->comment("multiple in json format");
            $table->text('body_text_bn')->nullable()->comment("multiple in json format");           
            $table->string('page_type', 100)->nullable()->comment('i.e: about roaming, bill payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('roaming_general_pages');
    }

}
