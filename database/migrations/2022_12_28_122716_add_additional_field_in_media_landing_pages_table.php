<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInMediaLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_landing_pages', function (Blueprint $table) {
            $table->string('reference_type')->nullable()->after('id');
            $table->integer('reference_id')->nullable()->after('reference_type');
            $table->mediumText('short_desc_en')->nullable()->after('title_bn');
            $table->mediumText('short_desc_bn')->nullable()->after('short_desc_en');
            $table->json('slider_items')->nullable()->after('items');
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
            $table->dropColumn('reference_type');
            $table->dropColumn('reference_id');
            $table->dropColumn('short_desc_en');
            $table->dropColumn('short_desc_bn');
            $table->dropColumn('slider_items');
        });
    }
}
