<?php

use Illuminate\Database\Seeder;

class SettingKeysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        // \DB::table('setting_keys')->delete();
        
        \DB::table('setting_keys')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Offer',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Short Cuts',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'SMS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Internet',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Talk Time',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}