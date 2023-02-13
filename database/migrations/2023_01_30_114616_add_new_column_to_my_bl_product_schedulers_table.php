<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToMyBlProductSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_product_schedulers', function (Blueprint $table) {
            $table->string('commercial_name_en')->nullable();
            $table->string('commercial_name_bn')->nullable();
            $table->string('display_title_en')->nullable();
            $table->string('display_title_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_product_schedulers', function (Blueprint $table) {
            //
        });
    }
}
