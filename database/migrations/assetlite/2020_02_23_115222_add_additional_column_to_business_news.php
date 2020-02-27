<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalColumnToBusinessNews extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('business_news', function (Blueprint $table) {
            $table->string('alt_text', 250)->nullable()->after('image_url');
            $table->string('title_bn', 250)->nullable()->after('title');
            $table->tinyInteger('sliding_speed')->default(1)->after('image_url')->comment('in seconds');
            $table->tinyInteger('sort')->nullable()->after('status');
            $table->text('body_bn')->nullable()->after('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('business_news', function (Blueprint $table) {
            //
        });
    }

}
