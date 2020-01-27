<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsApproveToAdditionalAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additional_accounts', function (Blueprint $table) {
            $table->tinyInteger('is_approve');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('additional_accounts', function (Blueprint $table) {
            $table->dropColumn('is_approve');
        });
    }
}
