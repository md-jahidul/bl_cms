<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFixedPageHeaderScriptInMeteTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('keywords')->nullable()->change();
            $table->string('dynamic_route_key')->nullable()->after('title');
            $table->text('page_header')->nullable()->after('title');
            $table->text('page_header_bn')->nullable()->after('page_header');
            $table->text('schema_markup')->nullable()->after('page_header_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->dropColumn('dynamic_route_key');
            $table->dropColumn('page_header');
            $table->dropColumn('page_header_bn');
            $table->dropColumn('schema_markup');
        });
    }
}
