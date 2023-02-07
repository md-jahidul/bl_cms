<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCallToActionEcareerPortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecareer_portals', function (Blueprint $table) {
            $table->string('call_to_action',2000)->after('category_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecareer_portals', function (Blueprint $table) {
            $table->dropColumn('call_to_action');
        });
    }
}
