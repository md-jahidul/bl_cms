<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFieldLeadRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_requests', function (Blueprint $table) {
            $table->integer('lead_category_id')->after('id')->nullable();
            $table->integer('lead_product_id')->after('lead_category_id')->nullable();
            $table->string('lead_product_type')->after('lead_product_id')
                ->nullable()->comment('dynamic, static');
            $table->json('form_data')->after('lead_product_id')->nullable();
            $table->integer('updated_by')->after('form_data')->nullable();

            $table->dropColumn('category');
            $table->dropColumn('sub_category');
            $table->dropColumn('name');
            $table->dropColumn('company_name');
            $table->dropColumn('mobile');
            $table->dropColumn('email');
            $table->dropColumn('district');
            $table->dropColumn('thana');
            $table->dropColumn('address');
            $table->dropColumn('quantity');
            $table->dropColumn('package');
            $table->dropColumn('request_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_requests', function (Blueprint $table) {

            $table->dropColumn('lead_category_id');
            $table->dropColumn('lead_product_id');
            $table->dropColumn('lead_product_type');
            $table->dropColumn('form_data');
            $table->dropColumn('updated_by');


            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('address')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('package')->nullable();
            $table->string('request_type')->nullable();
        });
    }
}
