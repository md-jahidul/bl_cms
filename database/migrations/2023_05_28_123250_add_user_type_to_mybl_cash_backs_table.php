<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTypeToMyblCashBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mybl_cash_backs', function (Blueprint $table) {
            $table->string('user_type')->default('all')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mybl_cash_backs', function (Blueprint $table) {
            $table->dropColumn('user_type');
        });
    }
}
