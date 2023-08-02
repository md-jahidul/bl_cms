<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlLabSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_lab_summaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bl_lab_app_id');
            $table->string('idea_title')->nullable();
            $table->text('idea_details')->nullable();
            $table->string('industry')->nullable();
            $table->string('apply_for')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->foreign('bl_lab_app_id')
                ->references('id')
                ->on('bl_lab_applications')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bl_lab_summaries');
    }
}
