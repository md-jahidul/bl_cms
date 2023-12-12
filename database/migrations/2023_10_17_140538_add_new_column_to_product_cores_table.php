<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToProductCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->string('service_image_url')->nullable();
            $table->string('name_bn')->nullable();
            $table->boolean('show_timer')->default(0);
            $table->string('activation_type')->default('REGULAR');
            $table->string('cta_name_en')->nullable();
            $table->string('cta_name_bn')->nullable();
            $table->string('cta_bgd_color')->nullable();
            $table->string('cta_text_color')->nullable();
            $table->string('redirection_name_en')->nullable();
            $table->string('redirection_name_bn')->nullable();
            $table->string('redirection_deeplink')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->dropColumn('service_image_url');
            $table->dropColumn('name_bn');
            $table->dropColumn('show_timer');
            $table->dropColumn('activation_type');
            $table->dropColumn('cta_name_en');
            $table->dropColumn('cta_name_bn');
            $table->dropColumn('cta_bgd_color');
            $table->dropColumn('cta_text_color');
            $table->dropColumn('redirection_name_en');
            $table->dropColumn('redirection_name_bn');
            $table->dropColumn('redirection_deeplink');
        });
    }
}
