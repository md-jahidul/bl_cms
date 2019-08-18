<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_question', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('campaign_id')->unsigned()->nullable();
            $table->bigInteger('question_id')->unsigned()->nullable();

            $table->foreign('campaign_id')
                    ->references('id')
                    ->on('campaigns')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('question_id')
                    ->references('id')
                    ->on('questions')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');



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
        Schema::dropIfExists('campaign_question');
    }
}
