<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToShortcutUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shortcut_user', function (Blueprint $table) {
            $table->bigInteger('sequence')->unsigned();
            $table->bigInteger('serial')->default(1)->change();
            $table->renameColumn('serial', 'is_enable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shortcut_user', function (Blueprint $table) {
            $table->dropColumn('sequence');
            $table->renameColumn('is_enable', 'serial');
        });
    }
}
