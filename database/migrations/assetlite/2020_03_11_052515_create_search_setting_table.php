<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_setting', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('type', 100)->nullable();
            $table->string('type_slug', 100)->nullable();
            $table->tinyInteger('limit')->default(1);
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
        Schema::dropIfExists('search_setting');
    }
}
