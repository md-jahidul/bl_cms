<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeatureNameColumnToTermsConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('terms_conditions', 'feature_name')) {
            Schema::table('terms_conditions', function (Blueprint $table) {
                $table->string('feature_name')->after('platform')->default('general');
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
        if (Schema::hasColumn('terms_conditions', 'feature_name')) {
            Schema::table('terms_conditions', function (Blueprint $table) {
                $table->dropColumn('feature_name');
            });
        }
    }
}
