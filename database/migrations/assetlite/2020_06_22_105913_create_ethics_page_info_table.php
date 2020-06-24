<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEthicsPageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ethics_page_info', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('page_name_en')->nullable();
            $table->string('page_name_bn')->nullable();
            $table->string('banner_web')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->string('alt_text')->nullable();
            $table->longText('url_slug')->nullable();
            $table->longText('page_header')->nullable();
            $table->longText('schema_markup')->nullable();
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
        Schema::dropIfExists('ethics_page_info');
    }
}
