<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherDynamicPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_dynamic_page', function (Blueprint $table) {
             $table->mediumIncrements('id');
            $table->string('page_name_en')->nullable();
            $table->string('page_name_bn')->nullable();
            $table->string('url_slug')->nullable();
            $table->longText('page_content_en')->nullable();
            $table->longText('page_content_bn')->nullable();
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
        Schema::dropIfExists('other_dynamic_page');
    }
}
