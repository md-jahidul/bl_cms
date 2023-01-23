<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeAttributeEthicsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ethics_files', function (Blueprint $table) {
            $table->string('title_en')->after('file_path')->nullable();
            $table->string('title_bn')->after('file_path')->nullable();
            $table->text('description_bn')->after('file_path')->nullable();
            $table->text('description_en')->after('file_path')->nullable();
            $table->string('image_url')->after('file_path')->nullable();
            $table->string('image_name_en')->after('file_path')->nullable();
            $table->string('image_name_bn')->after('file_path')->nullable();
            $table->string('mobile_view_img')->after('file_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ethics_files', function (Blueprint $table) {
            //
        });
    }
}
