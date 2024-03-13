<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnBarredFlagsColumnInRoamingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_transactions', function (Blueprint $table) {
            $table->json('un_barred_flags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roaming_transactions', function (Blueprint $table) {
            $table->dropColumn('un_barred_flags');
        });
    }
}
