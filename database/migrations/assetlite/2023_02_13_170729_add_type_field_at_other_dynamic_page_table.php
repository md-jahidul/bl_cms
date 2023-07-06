<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeFieldAtOtherDynamicPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_dynamic_page', function (Blueprint $table) {
            $table->string('type')->nullable()->after('schema_markup')->default('other_dynamic_page');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_dynamic_page', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
