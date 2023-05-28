<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultipleAttributesColumnInExploreCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('explore_c_s', function (Blueprint $table) {
            $table->json('multiple_attributes')->nullable()->after('slug_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('explore_c_s', function (Blueprint $table) {
            $table->dropColumn('multiple_attributes');
        });
    }
}
