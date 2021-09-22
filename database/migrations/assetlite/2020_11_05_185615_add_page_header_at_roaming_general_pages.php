<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPageHeaderAtRoamingGeneralPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_general_pages', function(Blueprint $table) {
            if (!Schema::hasColumn('roaming_general_pages' ,'url_slug_en')) {
                $table->string('url_slug_en')->after('page_type')->nullable();
                $table->string('url_slug_bn')->after('url_slug_en')->nullable();
                $table->text('page_header_en')->after('url_slug_bn')->nullable();
                $table->text('page_header_bn')->after('page_header_en')->nullable();
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
       Schema::table('roaming_general_pages', function(Blueprint $table) {
            if (Schema::hasColumn('roaming_general_pages', 'url_slug_en')) {
                $table->dropColumn('url_slug_en');
                $table->dropColumn('url_slug_bn');
                $table->dropColumn('page_header_en');
                $table->dropColumn('page_header_bn');
                $table->dropColumn('schema_markup');
            }
       });
    }
}
