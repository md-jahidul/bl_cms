<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AaddAdditionalColumnToBusinessComponentPhotoText extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('business_component_photo_text', function (Blueprint $table) {
            $table->mediumText('text_bn')->nullable()->after('text');
            $table->string('alt_text', 250)->nullable()->after('photo_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('business_component_photo_text', function (Blueprint $table) {
            //
        });
    }

}
