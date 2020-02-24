<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AaddAdditionalColumnToBusinessComponentVideos extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('business_component_videos', function (Blueprint $table) {
            $table->string('name_bn', 200)->nullable()->after('name');
            $table->string('title_bn', 250)->nullable()->after('title');
            $table->text('description_bn')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('business_component_videos', function (Blueprint $table) {
            //
        });
    }

}
