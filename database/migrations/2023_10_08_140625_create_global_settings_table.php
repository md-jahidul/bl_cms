<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('global_settings');

        Schema::create('global_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('settings_key');
            $table->text('settings_value');
            $table->string('value_type')->default('string');
            $table->integer('android_min')->default(0);
            $table->integer('android_max')->default(9999);
            $table->integer('ios_min')->default(0);
            $table->integer('ios_max')->default(9999);
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_settings');
    }
}
