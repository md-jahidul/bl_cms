<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProductsTable
 */
class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code')->unique();
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('text')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('bonus')->nullable();
            $table->tinyInteger('show_in_home')->default(0);
            $table->string('ussd_bn', 30)->nullable();
            $table->integer('point')->nullable();
            $table->unsignedBigInteger('tag_category_id')->nullable();
            $table->unsignedBigInteger('sim_category_id');
            $table->unsignedBigInteger('offer_category_id');
            $table->text('contextual_message')->nullable();
            $table->integer('like')->default(0);
            $table->tinyInteger('is_recharge')->default(0)->comment('yes = 1, no = 0');
            $table->tinyInteger('is_auto_renewable')->nullable();
            $table->tinyInteger('is_gift_offer')->default(false);
            $table->tinyInteger('status')->default(1);
            $table->integer('display_order')->nullable();
            $table->json('offer_info')->nullable();


            $table->foreign('tag_category_id')
                ->references('id')
                ->on('tag_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('sim_category_id')
                ->references('id')
                ->on('sim_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('offer_category_id')
                ->references('id')
                ->on('offer_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('products');
    }
}
