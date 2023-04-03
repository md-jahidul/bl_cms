<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComponentSizeToGenericSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generic_sliders', function (Blueprint $table) {
            $table->string('component_size')->nullable()->after('id');
            $table->string('component_type')->nullable()->after('component_for');
            $table->boolean('scrollable')->nullable()->after('component_type');
            $table->string('icon')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generic_sliders', function (Blueprint $table) {
            $table->dropColumn('component_size');
            $table->dropColumn('component_type');
            $table->dropColumn('scrollable');
            $table->dropColumn('icon');
        });
    }
}
