<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePageHeaderTypeInEcareerPortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecareer_portals', function (Blueprint $table) {
            if (Schema::hasColumn('ecareer_portals', 'page_header_bn')) {
                $table->longText('page_header_bn')->change();
            }
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

        });
    }
}
