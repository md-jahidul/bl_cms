<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDialNumberToShortcutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shortcuts', function (Blueprint $table) {
            $table->string('dial_number')->after('component_identifier')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shortcuts', function (Blueprint $table) {
            $table->dropColumn('dial_number');
        });
    }
}
