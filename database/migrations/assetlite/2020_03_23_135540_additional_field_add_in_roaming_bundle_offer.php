<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdditionalFieldAddInRoamingBundleOffer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_bundle_offer', function (Blueprint $table) {
            $table->string('subscription_type')->after('product_code')->nullable();
            $table->string('country')->after('subscription_type')->nullable();
            $table->string('operator')->after('country')->nullable();
            $table->dropColumn('operator_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roaming_bundle_offer', function (Blueprint $table) {
            $table->dropColumn('subscription_type');
            $table->dropColumn('country');
            $table->dropColumn('operator');
            $table->string('operator_id')->after('product_code');
        });
    }
}
