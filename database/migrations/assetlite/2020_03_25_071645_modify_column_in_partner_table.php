<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnInPartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->string('company_name_en')->nullable()->change();
            $table->string('company_name_bn')->nullable()->change();
            $table->string('company_logo')->nullable()->change();
            $table->text('company_address')->nullable()->change();
            $table->string('company_website')->nullable()->change();
            $table->string('contact_person_name')->nullable()->change();
            $table->string('contact_person_email')->nullable()->change();
            $table->string('contact_person_mobile')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
            //
        });
    }
}
