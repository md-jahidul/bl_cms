<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAndRemoveColumnInBusinessTypeDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_type_datas', function (Blueprint $table) {
            $table->renameColumn('image_en', 'image_url');
            $table->renameColumn('image_bn', 'mobile_view_img');
            $table->dropColumn('description_en');
            $table->dropColumn('description_bn');
            $table->dropColumn('label_btn_en');
            $table->dropColumn('label_btn_bn');
            $table->dropColumn('url_en');
            $table->dropColumn('url_bn');
            $table->integer('display_order')->after('title_bn')->nullable();
            $table->longtext('other_attributes')->after('display_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_type_datas', function (Blueprint $table) {
            $table->renameColumn('image_url', 'image_en');
            $table->renameColumn('mobile_view_img', 'image_bn');
            $table->longText('description_en')->after('business_type_id')->nullable();
            $table->longText('description_bn')->after('business_type_id')->nullable();
            $table->string('label_btn_en')->after('business_type_id')->nullable();
            $table->string('label_btn_bn')->after('business_type_id')->nullable();
            $table->string('url_en')->after('business_type_id')->nullable();
            $table->string('url_bn')->after('business_type_id')->nullable();
            $table->dropColumn('display_order');
            $table->dropColumn('other_attributes');
        });
    }
}
