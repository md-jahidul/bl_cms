<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppServiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_service_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_service_tab_id');
            $table->unsignedBigInteger('app_service_cat_id');
            $table->unsignedBigInteger('tag_category_id')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_bn')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->integer('price_tk')->nullable()->default(0);
            $table->string('validity_unit')->nullable();
            $table->string('product_img_url')->nullable();
            $table->integer('like')->default(0);
            $table->double('app_rating', '10', '2')->default(0);
            $table->tinyInteger('can_active')->default(0);
            $table->string('ussd_en')->nullable();
            $table->string('ussd_Bn')->nullable();
            $table->string('subscribe_text_en')->nullable();
            $table->string('subscribe_text_bn')->nullable();
            $table->integer('send_to')->nullable();
            $table->string('app_store_link')->nullable();
            $table->string('google_play_link')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('app_service_tab_id')
                ->references('id')
                ->on('app_service_tabs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('app_service_cat_id')
                ->references('id')
                ->on('app_service_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_service_products');
    }
}
