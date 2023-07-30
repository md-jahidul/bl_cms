<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconToMyblAppMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mybl_app_menus', function (Blueprint $table) {
            $table->string('parent_icon')->after('icon')->nullable();
            $table->string('deeplink')->after('other_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mybl_app_menus', function (Blueprint $table) {
            $table->dropColumn('parent_icon');
            $table->dropColumn('deeplink');
        });
    }
}
