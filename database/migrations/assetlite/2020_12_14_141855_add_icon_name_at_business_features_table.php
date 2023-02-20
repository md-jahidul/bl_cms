<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconNameAtBusinessFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_features', function(Blueprint $table) {
            if(!Schema::hasColumn('business_features', 'icon_name_en')) {
                $table->string('icon_name_en')->after('icon_url')->nullable();
                $table->string('icon_name_bn')->after('icon_name_en')->nullable();
                $table->string('alt_text_bn')->after('alt_text')->nullable();
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
        Schema::table('business_features', function(Blueprint $table) {
            if(Schema::hasColumn('business_features', 'icon_name_en')) {
                $table->dropColumn('icon_name_en');
                $table->dropColumn('icon_name_bn');
                $table->dropColumn('alt_text_bn');
            }
        });
    }
}
