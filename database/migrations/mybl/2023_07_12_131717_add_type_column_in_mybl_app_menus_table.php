<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColumnInMyblAppMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mybl_app_menus', function (Blueprint $table) {
            $table->string('type')->default('all')->after('content_for');
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
            $table->dropColumn('type');
        });
    }
}
