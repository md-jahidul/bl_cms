<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEcareerPortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('ecareer_portals', function (Blueprint $table) {
            $table->string('image_mobile')->nullable()->after('image');
            $table->string('page_header')->nullable()->after('route_slug');
            $table->string('schema_markup')->nullable()->after('route_slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
