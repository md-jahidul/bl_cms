<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEcarrerPortalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecarrer_portal_items', function (Blueprint $table) {
            $table->tinyInteger('is_default')->default(0)->after('is_active')->comment('is_default 1 = Section is default, can not be deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecarrer_portal_items', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }
}
