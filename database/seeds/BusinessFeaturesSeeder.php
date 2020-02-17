<?php

use Illuminate\Database\Seeder;

class BusinessFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_features')->truncate();

        DB::table('business_features')->insert(array(
            0 =>
            array(
                'icon_url' => "",
                'title' => "This is text title",
                'sort' => 1,
                'status' => 1
            )
        ));
    }
}
