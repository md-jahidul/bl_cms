<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameEcareerTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('ecarrer_portals', 'ecareer_portals');
        Schema::rename('ecarrer_portal_forms', 'ecareer_portal_forms');
        Schema::rename('ecarrer_portal_items', 'ecareer_portal_items');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('ecareer_portals', 'ecarrer_portals');
        Schema::rename('ecareer_portal_forms', 'ecarrer_portal_forms');
        Schema::rename('ecareer_portal_items', 'ecarrer_portal_items');
    }
}
