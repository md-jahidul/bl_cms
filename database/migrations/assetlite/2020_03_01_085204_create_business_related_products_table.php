<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessRelatedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_related_products', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('product_id')->default(0);
             $table->integer('parent_id')->default(0);
             $table->tinyInteger('product_type')->default(0)->comment("1=package,2=enterprise solution");
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
        Schema::dropIfExists('business_related_products');
    }
}
