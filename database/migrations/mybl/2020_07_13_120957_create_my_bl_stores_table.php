<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('sub_category_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('highlight_text')->nullable();
            $table->text('description')->nullable();
            $table->text('type')->nullable();
            $table->text('ratings')->nullable();
            $table->text('total_ratings')->nullable();
            $table->text('btn_text')->nullable();
            $table->text('btn_action_type')->nullable();
            $table->text('btn_action_ios')->nullable();
            $table->text('btn_action_android')->nullable();
            $table->text('icon')->nullable();
            $table->text('image_url')->nullable();
            $table->text('video_link')->nullable();
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
        Schema::dropIfExists('my_bl_stores');
    }
}
