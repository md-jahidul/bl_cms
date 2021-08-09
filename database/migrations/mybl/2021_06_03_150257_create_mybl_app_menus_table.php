<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblAppMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_app_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->default(0);
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('component_identifier')->nullable();
            $table->string('icon')->nullable();
            $table->integer('display_order')->nullable();
            $table->string('key')->nullable();
            $table->string('deep_link_slug')->nullable();
            $table->json('other_info')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('mybl_app_menus');
    }
}
