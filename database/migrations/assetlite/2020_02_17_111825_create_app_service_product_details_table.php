<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateAppServiceProductDetailsTable extends Migration
{
    use SoftDeletes;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_service_product_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->nullable()->comment('app_service_products table id');
            $table->string('section_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('image')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('alt_links')->nullable();
            $table->string('tab_type')->nullable();
            $table->string('category')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('multiple_component')->default(0)->comment('Section has multiple component(1) or single component(0)');
            $table->integer('section_order')->nullable();
            $table->json('other_attributes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_service_product_details');
    }
}
