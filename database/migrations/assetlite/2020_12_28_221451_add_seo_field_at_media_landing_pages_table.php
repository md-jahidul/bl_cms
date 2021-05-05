<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldAtMediaLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_landing_pages', function (Blueprint $table) {
            if (!Schema::hasColumn('media_landing_pages', 'page_header')) {
                $table->text('page_header')->after('status')->nullable();
                $table->text('page_header_bn')->after('page_header')->nullable();
                $table->text('schema_markup')->after('page_header_bn')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_landing_pages', function (Blueprint $table) {
            if (Schema::hasColumn('media_landing_pages', 'page_header')) {
                $table->dropColumn('page_header');
                $table->dropColumn('page_header_bn');
                $table->dropColumn('schema_markup');
            }
        });
    }
}
