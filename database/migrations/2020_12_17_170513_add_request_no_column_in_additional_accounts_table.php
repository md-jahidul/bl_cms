<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequestNoColumnInAdditionalAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('additional_accounts', 'request_no')) {
            Schema::table('additional_accounts', function (Blueprint $table) {
                $table->integer('request_no')->default(1);
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
        if (Schema::hasColumn('additional_accounts', 'request_no')) {
            Schema::table('additional_accounts', function (Blueprint $table) {
                $table->dropColumn('request_no');
            });
        }
    }
}
