<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_footers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('redirect_url')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->longtext('other_attributes')->nullable();
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
        Schema::dropIfExists('sub_footers');
    }
}
