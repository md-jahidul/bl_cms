<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNonBlNavigationRailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_bl_navigation_rails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en', 100)->nullable();
            $table->string('title_bn', 100)->nullable();
            $table->string('customer_type', 50)->nullable();
            $table->string('component_identifier')->nullable();
            $table->integer('display_order')->nullable();
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
        Schema::dropIfExists('non_bl_navigation_rails');
    }
}
