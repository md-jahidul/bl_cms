<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchPopularKeywordsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('search_popular_keywords', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('keyword', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->integer('product_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('search_popular_keywords');
    }

}
