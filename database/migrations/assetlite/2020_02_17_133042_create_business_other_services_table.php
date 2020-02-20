<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessOtherServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_other_services', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 100)->nullable();
            $table->string('banner_photo', 250)->nullable();
            $table->tinyInteger('sliding_speed')->default(1)->comment('in seconds');
            $table->string('icon', 250)->nullable();
            $table->string('short_details', 250)->nullable();
            $table->string('offer_details', 250)->nullable();
            $table->tinyInteger('sort')->nullable();
            $table->string('type')->comment('Slug:business-solusion,iot,others');
            $table->tinyInteger('status')->default(1)->comment('1=show,0=hide');
            $table->tinyInteger('home_show')->default(0)->comment('1=show,0=hide');
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
        Schema::dropIfExists('business_other_services');
    }
}
