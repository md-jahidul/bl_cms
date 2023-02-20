<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameComponentKeyToShortCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('short_codes', function (Blueprint $table) {
            $table->renameColumn('component_keys', 'component_key');
            $table->string('component_url')->after('component_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('short_codes', function (Blueprint $table) {
            $table->dropColumn('component_url');
        });
    }
}
