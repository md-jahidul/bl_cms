<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEcarrerPortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecarrer_portals', function (Blueprint $table) {
            $table->integer('display_order')->default(0)->after('is_default')->comment('Display Order for sorting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecarrer_portals', function (Blueprint $table) {
            $table->dropColumn('display_order');
        });
    }
}
