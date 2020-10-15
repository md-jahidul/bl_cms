<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpResContactUsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corp_res_contact_us_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_type')->nullable();
            $table->string('component_title_en')->nullable();
            $table->string('component_title_bn')->nullable();
            $table->string('send_button_en')->nullable();
            $table->string('send_button_bn')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corp_res_contact_us_pages');
    }
}
