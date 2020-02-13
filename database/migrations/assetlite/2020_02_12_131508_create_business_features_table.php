<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_features', function (Blueprint $table) {
             $table->increments('id');
            $table->string('icon_url', 250)->nullable();
            $table->string('title', 250)->nullable();
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
    public function down()
    {
        Schema::dropIfExists('business_features');
    }
}
