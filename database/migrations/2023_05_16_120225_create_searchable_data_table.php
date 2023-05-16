<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchableDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searchable_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('featureable_id');
            $table->string('featureable_type');
            $table->string('product_code')->nullable();
            $table->string('type')->nullable();
            $table->string('page_title_en', 500)->index()->nullable();
            $table->string('page_title_bn', 500)->index()->nullable();
            $table->string('tag_en')->index()->nullable();
            $table->string('tag_bn')->index()->nullable();
            $table->string('url_slug_en')->nullable();
            $table->string('url_slug_bn')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('searchable_data');
    }
}
