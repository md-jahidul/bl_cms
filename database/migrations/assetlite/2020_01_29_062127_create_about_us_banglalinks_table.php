<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUsBanglalinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us_banglalinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('banglalink_info');
            $table->text('banglalink_info_bn')->nullable();
            $table->text('banner_image')->nullable();
            $table->text('content_image')->nullable();
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
        Schema::dropIfExists('about_us_banglalink');
    }
}
