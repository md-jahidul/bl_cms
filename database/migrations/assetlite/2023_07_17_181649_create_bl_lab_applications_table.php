<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlLabApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_lab_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bl_lab_user_id');
            $table->string('id_number');
            $table->string('application_status')->nullable();
            $table->string('step_completed')->nullable();
            $table->date('submitted_at')->nullable();
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
        Schema::dropIfExists('bl_lab_applications');
    }
}
