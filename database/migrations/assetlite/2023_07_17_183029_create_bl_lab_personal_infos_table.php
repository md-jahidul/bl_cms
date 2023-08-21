<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlLabPersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_lab_personal_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bl_lab_app_id');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('designation')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('profession')->nullable();
            $table->string('institute_or_org')->nullable();
            $table->string('education')->nullable();
            $table->mediumText('cv')->nullable();
            $table->text('team_members')->nullable();
            $table->boolean('applicant_agree')->nullable();
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
        Schema::dropIfExists('bl_lab_personal_infos');
    }
}
