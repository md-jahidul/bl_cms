<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeTypeToCsSelfcareReferrersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cs_selfcare_referrers', function (Blueprint $table) {
            $table->string('code_type')->after('referral_code')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cs_selfcare_referrers', function (Blueprint $table) {
            $table->dropColumn('code_type');
        });
    }
}
