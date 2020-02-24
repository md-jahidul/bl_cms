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
            $table->tinyInteger('is_default')->default(0)->after('has_items')->comment('is_default 1 = Section is default, can not be deleted');
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
            $table->dropColumn('is_default');
        });
    }
}
