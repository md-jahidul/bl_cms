<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveToAboutUsBanglalinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us_banglalink', function (Blueprint $table) {
            $table->tinyInteger('is_active')->after('other_attributes')->default(1);
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
            $table->dropColumn('is_active');
        });
    }
}
