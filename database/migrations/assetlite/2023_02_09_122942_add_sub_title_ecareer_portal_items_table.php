<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubTitleEcareerPortalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecareer_portal_items', function (Blueprint $table) {
            $table->string('sub_title_en')->after('title_bn')->nullable();
            $table->string('sub_title_bn')->after('title_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecareer_portal_items', function (Blueprint $table) {
            $table->dropColumn('sub_title_en');
            $table->dropColumn('sub_title_bn');
        });
    }
}
