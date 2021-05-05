<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRouteSlugBnAndOtherFieldAtEcareerPortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecareer_portals', function(Blueprint $table) {
            if(!Schema::hasColumn('ecareer_portals', 'route_slug_bn')) {
                $table->string('route_slug_bn')->after('route_slug')->nullable();
                $table->string('page_header_bn')->after('page_header')->nullable();
                $table->string('alt_text_bn')->after('alt_text')->nullable();
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
        Schema::table('ecareer_portals', function(Blueprint $table) {
            if(Schema::hasColumn('ecareer_portals', 'route_slug_bn')) {
                $table->dropColumn('route_slug_bn');
                $table->dropColumn('page_header_bn');
                $table->dropColumn('alt_text_bn');
                $table->dropColumn('banner_name_web_bn');
                $table->dropColumn('banner_name_mobile_en');
                $table->dropColumn('banner_name_mobile_bn');
            }
        });
    }
}
