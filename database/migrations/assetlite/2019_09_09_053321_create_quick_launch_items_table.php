<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuickLaunchItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_launch_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('en_title');
            $table->string('bn_title');
            $table->string('image_url');
            $table->string('alt_text');
            $table->string('link');
            $table->tinyInteger('status');
            $table->integer('display_order');
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
        Schema::dropIfExists('quick_launch_items');
    }
}
