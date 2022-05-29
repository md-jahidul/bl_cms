<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblCampaignProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_campaign_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('campaign_id');
            $table->integer('recharge_amount')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_type')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('desc_bn')->nullable();
            $table->string('cash_back_type')->nullable();
            $table->integer('cash_back_amount')->nullable();
            $table->integer('number_of_apply_times')->nullable();
            $table->integer('max_amount')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('banner')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->boolean('show_in_home')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('campaign_id')
                ->references('id')
                ->on('mybl_campaigns')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mybl_campaign_products');
    }
}
