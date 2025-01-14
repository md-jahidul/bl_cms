<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactsToCustomerContactBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_contact_backups', function (Blueprint $table) {
            $table->longText('contacts')->after('contact_backup');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_contact_backups', function (Blueprint $table) {
            $table->dropColumn('contacts');
        });
    }
}
