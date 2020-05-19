<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddBonusTypeToSignInBonusLogsTable
 */
class AddBonusTypeToSignInBonusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sign_in_bonus_logs', function (Blueprint $table) {
            $table->string('bonus_type')->after('msisdn')->default('SignIn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sign_in_bonus_logs', function (Blueprint $table) {
            $table->dropColumn('bonus_type');
        });
    }
}
