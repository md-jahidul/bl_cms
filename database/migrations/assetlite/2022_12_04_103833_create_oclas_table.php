<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOclasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oclas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quater')->nullable();
            $table->string('quater_bn')->nullable();
            $table->string('year')->nullable();
            $table->string('year_bn')->nullable();
            $table->string('image')->nullable();
            $table->string('image_bn')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('image_alt_bn')->nullable();
            $table->json('other_attributes')->nullable();
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
        Schema::dropIfExists('oclas');
    }
}
