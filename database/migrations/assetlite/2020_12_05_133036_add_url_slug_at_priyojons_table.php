<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlSlugAtPriyojonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('priyojons', function(Blueprint $table) {
            if(!Schema::hasColumn('priyojons', 'url_slug_en')) {
                $table->string('url_slug_en')->after('url')->nullable();
                $table->string('url_slug_bn')->after('url_slug_en')->nullable();
                $table->string('alias')->after('url_slug_bn')->nullable();
                $table->string('banner_name_web_bn')->after('banner_name')->nullable();
                $table->string('banner_name_mobile_en')->after('banner_name_web_bn')->nullable();
                $table->string('banner_name_mobile_bn')->after('banner_name_mobile_en')->nullable();
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
        Schema::table('priyojons', function(Blueprint $table) {
            if(Schema::hasColumn('priyojons', 'url_slug_en')) {
                $table->dropColumn('url_slug_en');
                $table->dropColumn('url_slug_bn');
                $table->dropColumn('alias');
                $table->dropColumn('banner_name_web_bn');
                $table->dropColumn('banner_name_mobile_en');
                $table->dropColumn('banner_name_mobile_bn');
            }
        });
    }
}
