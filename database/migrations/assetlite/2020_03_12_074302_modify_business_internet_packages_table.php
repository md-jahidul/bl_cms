<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBusinessInternetPackagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('business_internet_packages', function (Blueprint $table) {
            $table->text('package_details_en')->nullable()->after('product_name');
            $table->text('package_details_bn')->nullable()->after('product_name');
            $table->string('related_product')->nullable()->after('sms_rate_unit');
            $table->string('banner_photo')->nullable()->after('sms_rate_unit');
            $table->string('alt_text')->nullable()->after('sms_rate_unit');
            $table->dropColumn(['type', 'content', 'product_family', 'sms_volume', 'minutes_volume', 'is_auto_renewable', 'is_recharge_offer', 'is_gift_offer', 'offer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
    }

}
