<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanglaUrlFieldInSearchPopularKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('search_popular_keywords', function (Blueprint $table) {
            $table->string('keyword_bn')->after('keyword')->nullable();
            $table->string('url_bn')->after('url')->nullable();
            $table->string('type')->after('url_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_popular_keywords', function (Blueprint $table) {
            $table->dropColumn('keyword_bn');
            $table->dropColumn('url_bn');
            $table->dropColumn('type');
        });
    }
}
