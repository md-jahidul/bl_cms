<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalColumnComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->string('button_en')->nullable()->after('alt_links');
            $table->string('button_bn')->nullable()->after('button_en');
            $table->string('button_link')->nullable()->after('button_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn('button_en');
            $table->dropColumn('button_bn');
            $table->dropColumn('button_link');
        });
    }
}
