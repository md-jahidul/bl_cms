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
                $table->string('code');
                $table->string('name');
                $table->string('text')->nullable();
                $table->integer('price_tk')->nullable();
                $table->integer('price_vat_included')->default(0);
                $table->integer('sms_volume')->nullable();
                $table->integer('min_volume')->nullable();
                $table->integer('internet_volume_mb')->nullable();
                $table->string('bonus')->nullable();
                $table->tinyInteger('is_recharge')->default('no')->comment('yes = 1, no = 0');
                $table->tinyInteger('show_in_home')->default(0);
                $table->string('validity_days')->nullable();
                $table->string('ussd', 20)->nullable();
                $table->string('point')->nullable();
                $table->unsignedBigInteger('tag_category_id')->nullable();
                $table->unsignedBigInteger('sim_category_id');
                $table->unsignedBigInteger('offer_category_id');
                $table->string('contextual_message')->nullable();
                $table->integer('like')->default(0);
                $table->tinyInteger('status')->default(1);
                $table->integer('display_order')->nullable();

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
