<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlagsToEcareerPortalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecareer_portal_items', function (Blueprint $table) {
            $table->string('slug',255)->after('ecarrer_portals_id')->nullable();
        });

        Schema::table('ecareer_portals', function (Blueprint $table) {
            $table->tinyInteger('is_program')->after('has_items')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecareer_portal_items', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('ecareer_portals', function (Blueprint $table) {
            $table->dropColumn('is_program');
        });
    }
}
