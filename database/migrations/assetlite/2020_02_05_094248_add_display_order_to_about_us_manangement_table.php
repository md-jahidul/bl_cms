<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDisplayOrderToAboutUsManangementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us_manangement', function (Blueprint $table) {
            $table->integer('display_order')->nullable()->after('others_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_us_manangement', function (Blueprint $table) {
            $table->dropColumn('display_order');
        });
    }
}
