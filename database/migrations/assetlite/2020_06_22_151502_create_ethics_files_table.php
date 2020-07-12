<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEthicsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ethics_files', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('file_name_en')->nullable();
            $table->string('file_name_bn')->nullable();
            $table->string('file_path')->nullable();
            $table->string('status')->nullable();
            $table->string('sort')->default(1)->nullable();
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
        Schema::dropIfExists('ethics_files');
    }
}
