<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInOtherDynamicPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_dynamic_page', function (Blueprint $table) {
            $table->text('page_header')->nullable()->after('id');
            $table->text('schema_markup')->nullable()->after('page_header');
            $table->string('banner_image_url')->nullable()->after('schema_markup');
            $table->string('banner_mobile_view')->nullable()->after('banner_image_url');
            $table->string('alt_text')->nullable()->after('banner_mobile_view');
            $table->string('banner_name')->nullable()->after('alt_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_dynamic_page', function (Blueprint $table) {
            $table->dropColumn('page_header');
            $table->dropColumn('schema_markup');
            $table->dropColumn('banner_image_url');
            $table->dropColumn('banner_mobile_view');
            $table->dropColumn('alt_text');
            $table->dropColumn('banner_name');
        });
    }
}
