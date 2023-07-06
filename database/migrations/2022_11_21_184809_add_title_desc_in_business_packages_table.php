<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleDescInBusinessPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->string('banner_title_en')->nullable()->after('banner_name_bn');
            $table->string('banner_title_bn')->nullable()->after('banner_title_en');;
            $table->text('banner_desc_en')->nullable()->after('banner_title_bn');;
            $table->text('banner_desc_bn')->nullable()->after('banner_desc_en');;
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
            $table->dropColumn('banner_title_en');
            $table->dropColumn('banner_title_bn');
            $table->dropColumn('banner_desc_en');
            $table->dropColumn('banner_desc_bn');
        });
    }
}
