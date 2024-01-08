<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('icon')->nullable();
            $table->boolean('is_title_show')->default(false);
            $table->integer('sequence')->nullable();
            $table->boolean('status')->default(false);
            $table->bigInteger('android_version_code_min')->default(0);
            $table->bigInteger('android_version_code_max')->default(999999999);
            $table->bigInteger('ios_version_code_min')->default(0);
            $table->bigInteger('ios_version_code_max')->default(999999999);
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
        Schema::dropIfExists('my_bl_services');
    }
}
