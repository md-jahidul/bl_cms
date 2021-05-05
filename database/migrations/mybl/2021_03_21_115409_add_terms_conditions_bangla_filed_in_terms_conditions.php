<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTermsConditionsBanglaFiledInTermsConditions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terms_conditions', function (Blueprint $table) {
            $table->longText('terms_conditions_bn')->nullable()->after('terms_conditions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('terms_conditions', function (Blueprint $table) {
            $table->string('terms_conditions_bn');
        });
    }
}
