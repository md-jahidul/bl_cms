<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopupBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banner', 192);
            $table->string('deeplink', 300);
            $table->integer('display_order')->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('is_priority')->default(0);
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
        Schema::dropIfExists('popup_banners');
    }
}
