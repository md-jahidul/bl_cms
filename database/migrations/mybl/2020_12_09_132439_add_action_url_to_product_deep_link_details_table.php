<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActionUrlToProductDeepLinkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('product_deep_link_details', 'action_url')) {
            Schema::table('product_deep_link_details', function (Blueprint $table) {
                $table->string('action_url')->default(true)->after('action_status');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         if (Schema::hasColumn('product_deep_link_details', 'action_url')) {
            Schema::table('product_deep_link_details', function (Blueprint $table) {
                $table->dropColumn('action_url');
            });
        }
    }
}
