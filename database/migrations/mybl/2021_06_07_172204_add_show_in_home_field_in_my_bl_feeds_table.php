<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowInHomeFieldInMyBlFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_feeds', function (Blueprint $table) {
            $table->boolean('show_in_home')->default(false)->after('availability');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_feeds', function (Blueprint $table) {
            $table->dropColumn('show_in_home');
        });
    }
}
