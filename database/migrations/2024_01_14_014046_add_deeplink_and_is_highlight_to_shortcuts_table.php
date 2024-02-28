<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeeplinkAndIsHighlightToShortcutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shortcuts', function (Blueprint $table) {
            $table->boolean('is_highlight')->default(0);
            $table->string('deeplink')->nullable();
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
            $table->dropColumn('is_highlight');
            $table->dropColumn('deeplink');
        });
    }
}
