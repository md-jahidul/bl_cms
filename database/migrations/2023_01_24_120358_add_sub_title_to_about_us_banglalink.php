<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubTitleToAboutUsBanglalink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us_banglalink', function (Blueprint $table) {
            //
            $table->string('sub_title')->nullable()->after('title_bn');
            $table->string('sub_title_bn')->nullable()->after('sub_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_us_banglalink', function (Blueprint $table) {
            //
            $table->dropColumn('sub_title');
            $table->dropColumn('sub_title_bn');
        });
    }
}
