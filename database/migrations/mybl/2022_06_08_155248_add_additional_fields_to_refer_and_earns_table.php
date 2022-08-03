<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToReferAndEarnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('refer_and_earns', function (Blueprint $table) {
            $table->string('claim_reward_type')->default('unlimited')->after('icon');
            $table->smallInteger('capping_interval')->nullable()->after('claim_reward_type');
            $table->integer('number_of_referrals')->nullable()->after('capping_interval');
            $table->integer('claim_validity_days')->nullable()->after('number_of_referrals');
            $table->longText('description_en')->nullable()->after('remind_interval_days');
            $table->longText('description_bn')->nullable()->after('description_en');

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
            //
        });
    }
}
