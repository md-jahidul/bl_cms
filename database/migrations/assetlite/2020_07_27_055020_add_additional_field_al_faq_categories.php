<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldAlFaqCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('al_faq_categories', function (Blueprint $table) {
            $table->text('description_en')->after('slug')->nullable();
            $table->text('description_bn')->after('description_en')->nullable();
            $table->integer('created_by')->after('description_bn')->nullable();
            $table->integer('updated_by')->after('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('al_faq_categories', function (Blueprint $table) {
            $table->dropColumn('description_en');
            $table->dropColumn('description_bn');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
}
