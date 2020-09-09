<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCustomerFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    public function up()
//    {
//        Schema::table('customer_feedback', function (Blueprint $table) {
//            $table->dropColumn('answers');
//            $table->json('answers')->nullable()->change();
//            $table->dropColumn('page_id');
//            $table->text('page_name');
//        });
//    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
//    public function down()
//    {
//        Schema::table('customer_feedback', function (Blueprint $table) {
//            $table->longText('answers')->nullable()->change();
//            $table->mediumInteger('page_id');
//            $table->dropColumn('page_name');
//        });
//    }
}
