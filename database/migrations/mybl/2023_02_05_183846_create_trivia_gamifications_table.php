<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriviaGamificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trivia_gamifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banner');
            $table->string('pending_bottom_label_en')->nullable();
            $table->string('pending_bottom_label_bn')->nullable();
            $table->string('completed_bottom_label_en')->nullable();
            $table->string('completed_bottom_label_bn')->nullable();
            $table->string('success_left_btn_en')->nullable();
            $table->string('success_left_btn_bn')->nullable();
            $table->string('success_left_btn_deeplink')->nullable();
            $table->string('success_right_btn_en')->nullable();
            $table->string('success_right_btn_bn')->nullable();
            $table->string('success_right_btn_deeplink')->nullable();
            $table->string('failed_left_btn_en')->nullable();
            $table->string('failed_left_btn_bn')->nullable();
            $table->string('failed_left_btn_deeplink')->nullable();
            $table->string('failed_right_btn_en')->nullable();
            $table->string('failed_right_btn_bn')->nullable();
            $table->string('failed_right_btn_deeplink')->nullable();
            $table->string('success_message_en')->nullable();
            $table->string('success_message_bn')->nullable();
            $table->string('failed_message_en')->nullable();
            $table->string('failed_message_bn')->nullable();
            $table->string('show_answer_btn_en')->nullable();
            $table->string('show_answer_btn_bn')->nullable();
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
        Schema::dropIfExists('trivia_gamifications');
    }
}
