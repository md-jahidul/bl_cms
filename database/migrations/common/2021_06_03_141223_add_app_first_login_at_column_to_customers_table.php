<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppFirstLoginAtColumnToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('customers', 'app_first_login_at')) {

            Schema::table('customers', function (Blueprint $table) {
                $table->dateTime('app_first_login_at')->nullable()->after('last_login_at');
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
        if (Schema::hasColumn('customers', 'app_first_login_at')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropColumn('app_first_login_at');
            });
        }
    }
}
