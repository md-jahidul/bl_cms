<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVarcharTextEcareerPortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecareer_portals', function (Blueprint $table) {
            $table->text('description_en')->change();
            $table->text('description_bn')->change();
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
            $table->string('description_en')->change();
            $table->string('description_en')->change();
        });
    }
}
