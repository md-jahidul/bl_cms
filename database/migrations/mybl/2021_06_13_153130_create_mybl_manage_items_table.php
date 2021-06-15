<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblManageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_manage_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('manage_categories_id');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('component_identifier')->nullable();
            $table->string('image_url')->nullable();
            $table->json('other_info')->nullable();
            $table->integer('display_order')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->foreign('manage_categories_id')
                ->references('id')
                ->on('mybl_manage_categories')
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
        Schema::dropIfExists('mybl_manage_items');
    }
}
