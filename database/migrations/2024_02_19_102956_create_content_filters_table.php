<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_filters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content_for');
            $table->string('content_type');
            $table->string('title_en');
            $table->string('title_bn');
            $table->integer('display_order');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('content_filters');
    }
}
