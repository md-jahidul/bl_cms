<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleDescriptionLabelToShortCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('short_codes', function (Blueprint $table) {
            $table->string('title_en')->after('component_type')->nullable();
            $table->string('title_bn')->after('component_type')->nullable();
            $table->text('description_en')->after('component_type')->nullable();
            $table->text('description_bn')->after('component_type')->nullable();
            $table->text('link_en')->after('component_type')->nullable();
            $table->text('link_bn')->after('component_type')->nullable();
            $table->text('label_en')->after('component_type')->nullable();
            $table->text('label_bn')->after('component_type')->nullable();
            $table->tinyInteger('is_label_active')->after('component_type')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('short_codes', function (Blueprint $table) {
            $table->dropColumn('title_en');
            $table->dropColumn('title_bn');
            $table->dropColumn('description_en');
            $table->dropColumn('description_bn');
            $table->dropColumn('link_en');
            $table->dropColumn('link_bn');
            $table->dropColumn('label_en');
            $table->dropColumn('label_bn');
            $table->dropColumn('is_label_active');
        });
    }
}
