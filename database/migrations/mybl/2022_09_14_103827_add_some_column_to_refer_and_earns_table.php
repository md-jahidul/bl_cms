<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnToReferAndEarnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('refer_and_earns', function (Blueprint $table) {
            $table->boolean('is_auto_claim')->default(0)->after('claim_validity_days');
            $table->unsignedBigInteger('exclude_base_groups_id')->nullable()->after('is_auto_claim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('refer_and_earns', function (Blueprint $table) {
            $table->dropColumn('is_auto_claim');
            $table->dropColumn('exclude_base_groups_id');
        });
    }
}
