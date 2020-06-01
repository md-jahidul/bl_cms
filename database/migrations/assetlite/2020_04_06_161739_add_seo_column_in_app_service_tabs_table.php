<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoColumnInAppServiceTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_tabs', function (Blueprint $table) {
            $table->text('page_header')->nullable()->after('banner_alt_text');
            $table->text('schema_markup')->nullable()->after('banner_alt_text');
            $table->string('url_slug')->nullable()->after('banner_alt_text');
            $table->string('banner_name', 200)->nullable()->after('banner_alt_text');
            $table->string('banner_image_mobile')->nullable()->after('banner_alt_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_service_tabs', function (Blueprint $table) {
            $table->dropColumn('page_header');
            $table->dropColumn('schema_markup');
            $table->dropColumn('url_slug');
            $table->dropColumn('banner_name');
            $table->dropColumn('banner_image_mobile');
        });
    }
}
