<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributesToBusinessPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->string('icon')->after('name_bn')->nullable();
            $table->string('icon_name_en')->after('name_bn')->nullable();
            $table->string('icon_name_bn')->after('name_bn')->nullable();
            $table->string('detail_image')->after('name_bn')->nullable();
            $table->string('detail_image_name_en')->after('name_bn')->nullable();
            $table->string('detail_image_name_bn')->after('name_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->dropColumn('icon');
            $table->dropColumn('icon_name_en');
            $table->dropColumn('icon_name_bn');
            $table->dropColumn('detail_image');
            $table->dropColumn('detail_image_name_en');
            $table->dropColumn('detail_image_name_bn');
        });
    }
}
