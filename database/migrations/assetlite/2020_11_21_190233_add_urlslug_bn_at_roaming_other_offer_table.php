<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlslugBnAtRoamingOtherOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_other_offer', function(Blueprint $table) {
            if (!Schema::hasColumn('roaming_other_offer', 'url_slug_bn')) {
                $table->string('url_slug_bn')->after('url_slug')->nullable();
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
        Schema::table('roaming_other_offer', function(Blueprint $table) {
            if (Schema::hasColumn('roaming_other_offer', 'url_slug_bn')) {
                $table->dropColumn('url_slug_bn');
            }
        });
    }
}
