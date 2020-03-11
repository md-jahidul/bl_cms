<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchDataTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('search_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->default(0);
            $table->string('product_name', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('tag', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('search_data');
    }

}
