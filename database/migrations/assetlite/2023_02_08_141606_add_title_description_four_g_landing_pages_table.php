<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleDescriptionFourGLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('four_g_landing_pages', function (Blueprint $table) {
            $table->text('description_bn')->after('title_bn')->nullable();
            $table->text('description_en')->after('title_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('four_g_landing_pages', function (Blueprint $table) {
            $table->dropColumn('description_en');
            $table->dropColumn('description_bn');
        });
    }
}
