<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToAboutUsBanglalinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us_banglalink', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('banglalink_info_bn');
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
            $table->dropColumn('slug');
        });
    }
}
