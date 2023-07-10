<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommerceBillUtilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_bill_utilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('commerce_bill_category_id');
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('logo')->nullable();
            $table->string('slug')->nullable();
            $table->integer('display_order')->nullable();
            $table->string('utility_code');
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('commerce_bill_category_id')
                ->references('id')
                ->on('commerce_bill_categories')
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
        Schema::dropIfExists('commerce_bill_utilities');
    }
}
