<?php

use Illuminate\Database\Seeder;

class RoamingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roaming_cagegories')->truncate();
        
        DB::table('roaming_cagegories')->insert(array (
            0 =>
            array (
                'name_en' => 'Offer',
                'sort' => 1,
              
            ),
            1 =>
            array (
                'name_en' => 'About Roaming',
                'sort' => 2,
              
            ),
            2 =>
            array (
                'name_en' => 'Roaming Rates',
                'sort' => 3,
              
            ),
            3 =>
            array (
                'name_en' => 'Bill Payment',
                'sort' => 4,
              
            ),
            4 =>
            array (
                'name_en' => 'Info & Tips',
                'sort' => 5,
              
            ),
            
        ));
    }
}
