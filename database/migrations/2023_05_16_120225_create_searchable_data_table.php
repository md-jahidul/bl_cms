<?php

use Illuminate\Support\Facades\DB;
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
            $table->text('page_title_en')->nullable();
            $table->text('page_title_bn')->nullable();
            $table->text('tag_en')->nullable();
            $table->text('tag_bn')->nullable();
            $table->string('url_slug_en')->nullable();
            $table->string('url_slug_bn')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        // Fulltext search index
        DB::statement('ALTER TABLE searchable_data ADD FULLTEXT search(page_title_en,page_title_bn,tag_en,tag_bn)');
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
