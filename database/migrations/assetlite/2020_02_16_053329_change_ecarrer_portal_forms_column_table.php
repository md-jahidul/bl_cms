<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEcarrerPortalFormsColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecarrer_portal_forms', function (Blueprint $table) {
            if(Schema::hasColumn('ecarrer_portal_forms', 'university')){
                $table->dropColumn('university');
            }
            
            $table->string('applicant_cv', 500)->nullable()->after('address');
            $table->integer('university_id')->nullable()->after('email')->comment('Id from universities table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
