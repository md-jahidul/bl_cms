<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToLmsHomeComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lms_home_components', function (Blueprint $table) {
            $table->string('type')->default('parent');
            $table->string('icon')->nullable();
            $table->string('cta_name_en')->nullable();
            $table->string('cta_name_bn')->nullable();
            $table->string('deeplink')->nullable();
            $table->bigInteger('other_component_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lms_home_components', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('icon');
            $table->dropColumn('cta_name_en');
            $table->dropColumn('cta_name_bn');
            $table->dropColumn('deeplink');
            $table->dropColumn('other_component_id');
        });
    }
}
