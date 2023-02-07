<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameFieldInAlFaqCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('al_faq_categories', function (Blueprint $table) {
            $table->string('name_en')->after('title')->default('Frequently Asked Questions');
            $table->string('name_bn')->after('name_en')->default('প্রায়শই জিজ্ঞাসিত প্রশ্নাবলী (এফএকিউ)');
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
            $table->dropColumn('name_en');
            $table->dropColumn('name_bn');
        });
    }
}
