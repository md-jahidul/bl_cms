<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessProductCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('business_product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->nullable();
            $table->tinyInteger('home_show')->default(0)->comment('1=show,0=hide');
            $table->tinyInteger('home_sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('business_product_categories');
    }

}
