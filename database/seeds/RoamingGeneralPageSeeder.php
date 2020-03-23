<?php

use Illuminate\Database\Seeder;

class RoamingGeneralPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('roaming_general_pages')->truncate();
        
        DB::table('roaming_general_pages')->insert(array (
            0 =>
            array (
                'title_en' => 'How To Activate Roaming',
                'page_type' => 'about-roaming',
              
            ),
            1 =>
            array (
                'title_en' => 'Bill Payment Options',
                'page_type' => 'bill-payment',
              
            ),
         
            
        ));
    }
}
