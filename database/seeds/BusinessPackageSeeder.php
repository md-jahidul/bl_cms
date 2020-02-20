<?php

use Illuminate\Database\Seeder;

class BusinessPackageSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('business_packages')->truncate();

        DB::table('business_packages')->insert(array(
            0 =>
            array(
                'name' => "Corporate Package",
                'banner_photo' => "",
                'short_details' => "Internet, minutes or call rate; whatever you choose, you can enjoy as much as you want with greater validity! With the first recharge of Tk. 48, you can enjoy a special call rate of 1 paisa/second to any.",
                'main_details' => "<strong>In this package you will get:</strong> <br><ul><li>3000 minutes to any local operator</li></ul>",
                'offer_details' => "<strong>In this package you will get:</strong> <br><ul><li>3000 minutes to any local operator</li></ul>",
                'home_show' => 1,
                'sort' => 1,
            )
        ));
    }

}
