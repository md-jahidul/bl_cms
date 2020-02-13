<?php

use Illuminate\Database\Seeder;

class BusinessHomeBannerSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('business_home_banner')->truncate();

        DB::table('business_home_banner')->insert(array(
            0 =>
            array(
                'id' => 1,
                'image_name' => '',
                'home_sort' => 1
            ),
            1 =>
            array(
                'id' => 2,
                'image_name' => '',
                'home_sort' => 2
            )
        ));
    }

}
