<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlSiteMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_site_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tag_type')->nullable()->comment('parent tag: url_set, sub_tag: url');
            $table->string('url_set')->nullable();
            $table->string('loc')->nullable();
            $table->string('last_mod')->nullable();
            $table->string('change_freq')->nullable();
            $table->string('priority')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('al_site_maps');
    }
}
