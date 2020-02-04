<?php

use Illuminate\Database\Seeder;

class AmarOfferDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('amar_offer_details')->insert([
            'details_en' => '',
            'details_bn' => '',
            'type' => 1
        ]);
        DB::table('amar_offer_details')->insert([
            'details_en' => '',
            'details_bn' => '',
            'type' => 2
        ]);
        DB::table('amar_offer_details')->insert([
            'details_en' => '',
            'details_bn' => '',
            'type' => 3
        ]);
        
    }
}
