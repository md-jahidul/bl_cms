<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_url', 250)->nullable();
            $table->string('title', 250)->nullable();
            $table->text('body')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1=show,0=hide');
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
        Schema::dropIfExists('business_news');
    }
}
