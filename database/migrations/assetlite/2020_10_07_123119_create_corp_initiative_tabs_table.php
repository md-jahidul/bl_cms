<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpInitiativeTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corp_initiative_tabs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('slug')->nullable();
            $table->text('url_slug_en')->nullable();
            $table->text('url_slug_bn')->nullable();
            $table->longText('page_header')->nullable();
            $table->longText('page_header_bn')->nullable();
            $table->longText('schema_markup')->nullable();
            $table->integer('display_order')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('corp_initiative_tabs');
    }
}
