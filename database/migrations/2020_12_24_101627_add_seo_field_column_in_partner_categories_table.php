<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldColumnInPartnerCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_categories', function (Blueprint $table) {
            $table->text('page_header')->nullable()->after('name_bn');
            $table->text('page_header_bn')->nullable()->after('page_header');
            $table->text('schema_markup')->nullable()->after('page_header_bn');
            $table->string('url_slug_en')->nullable()->after('schema_markup');
            $table->string('url_slug_bn')->nullable()->after('url_slug_en');
            $table->integer('display_order')->nullable()->after('url_slug_bn');
            $table->tinyInteger('status')->nullable()->after('display_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_categories', function (Blueprint $table) {
            $table->dropColumn('page_header');
            $table->dropColumn('page_header_bn');
            $table->dropColumn('schema_markup');
            $table->dropColumn('url_slug_en');
            $table->dropColumn('url_slug_bn');
            $table->dropColumn('display_order');
            $table->dropColumn('status');
        });
    }
}
