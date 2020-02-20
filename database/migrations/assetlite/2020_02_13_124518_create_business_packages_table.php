<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessPackagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('business_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250)->nullable();
            $table->string('banner_photo', 250)->nullable();
            $table->string('short_details', 250)->nullable();
            $table->text('main_details')->nullable();
            $table->text('offer_details')->nullable();
            $table->tinyInteger('home_show')->default(0)->comment('1=show,0=hide');
            $table->tinyInteger('sort')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=show,0=hide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('business_packages');
    }

}
