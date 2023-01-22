<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameColumnInBusinessTypeDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_type_datas', function (Blueprint $table) {
            $table->string('image_name')->after('display_order')->nullable();
            $table->string('image_name_bn')->after('display_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_type_datas', function (Blueprint $table) {
            $table->dropColumn('image_name');
            $table->dropColumn('image_name_bn');
        });
    }
}
