<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPinToTopSequenceToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_products', function (Blueprint $table) {
            $table->integer('pin_to_top_sequence')->default(10000)->after('pin_to_top');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_products', function (Blueprint $table) {
            $table->dropColumn('pin_to_top_sequence');
        });
    }
}
