<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerFeedbackQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_feedback_questions', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->text('question_en')->nullable();
            $table->text('question_bn')->nullable();
            $table->longText('answers_en')->nullable();
            $table->longText('answers_bn')->nullable();
            $table->tinyInteger('type')->default(1)->comment("1=radio,2=text");
            $table->tinyInteger('sort')->default(1);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('customer_feedback_questions');
    }
}
