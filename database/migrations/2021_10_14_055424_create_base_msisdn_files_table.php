<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseMsisdnFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_msisdn_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('base_msisdn_group_id');
            $table->string('title')->nullable();
            $table->string('file_name')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->foreign('base_msisdn_group_id')->references('id')->on('base_msisdn_groups');
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
        Schema::dropIfExists('base_msisdn_files');
    }
}
