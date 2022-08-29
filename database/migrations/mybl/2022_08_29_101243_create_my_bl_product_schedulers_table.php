<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlProductSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_product_schedulers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code', 100)->index();
            $table->string('media')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_visible')->nullable();
            $table->boolean('pin_to_top')->nullable();
            $table->boolean('base_msisdn_group_id')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
        Schema::dropIfExists('my_bl_product_schedulers');
    }
}
