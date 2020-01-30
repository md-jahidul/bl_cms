<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUsManangementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us_manangements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->string('designation');
            $table->string('designation_bn')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->text('personal_details')->nullable();
            $table->text('personal_details_bn')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('others_link')->nullable();
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
        Schema::dropIfExists('about_us_manangement');
    }
}
