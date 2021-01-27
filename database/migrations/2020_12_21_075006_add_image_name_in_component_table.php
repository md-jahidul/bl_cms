<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameInComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->string('alt_text_bn')->after('alt_text')->nullable();
            $table->string('image_name_en')->after('alt_text_bn')->nullable();
            $table->string('image_name_bn')->after('image_name_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn('alt_text_bn');
            $table->dropColumn('image_name_en');
            $table->dropColumn('image_name_bn');
        });
    }
}
