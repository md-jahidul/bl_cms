<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInReferrersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referrers', function (Blueprint $table) {
            if (!Schema::hasColumn('referrers', 'claimed_from')) {
                $table->date('claimed_from')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referrers', function (Blueprint $table) {
            if (Schema::hasColumn('referrers', 'claimed_from')) {
                $table->dropColumn('claimed_from');
            }
        });
    }
}
