<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamificationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamification_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_en')->nullable();
            $table->string('type_bn')->nullable();
            $table->string('content_for')->nullable();
            $table->json('trivia_gamification_ids');
            $table->integer('display_order')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('gamification_types');
    }
}
