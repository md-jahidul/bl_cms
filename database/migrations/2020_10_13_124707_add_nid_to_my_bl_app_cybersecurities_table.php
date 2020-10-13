<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNidToMyBlAppCybersecuritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('my_bl_app_cybersecurities','nid')) {
        Schema::table('my_bl_app_cybersecurities', function (Blueprint $table) {
            $table->string('nid')->nullable()->after('id');
         });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('my_bl_app_cybersecurities','nid')) {
            Schema::table('my_bl_app_cybersecurities', function (Blueprint $table) {
                $table->dropColumn('nid');
             });
            }
    }
}
