<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoColumnsOfferCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('offer_categories', function (Blueprint $table) {
            $table->text('page_header')->nullable()->after('banner_alt_text');
            $table->text('schema_markup')->nullable()->after('banner_alt_text');
            $table->string('url_slug')->nullable()->after('banner_alt_text');
            $table->string('banner_name', 200)->nullable()->after('banner_alt_text');
            $table->string('banner_image_mobile')->nullable()->after('banner_alt_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
