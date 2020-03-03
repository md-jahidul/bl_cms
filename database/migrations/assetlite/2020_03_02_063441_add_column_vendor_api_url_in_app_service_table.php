<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnVendorApiUrlInAppServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->string('provider_url')->after('subscribe_text_bn');
            $table->tinyInteger('show_in_vas')->after('can_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->dropColumn('provider_url');
            $table->dropColumn('show_in_vas');
        });
    }
}
