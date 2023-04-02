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
            $table->string('banner_text_en')->nullable()->after('title_bn');
            $table->string('banner_text_bn')->nullable()->after('banner_text_en');
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
            $table->dropColumn('banner_text_en');
            $table->dropColumn('banner_text_bn');
        });
    }
}
