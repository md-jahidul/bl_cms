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
        

        \DB::table('setting_keys')->delete();
        
        \DB::table('setting_keys')->insert(array (
            0 => 
            array (
                'id' => 13,
                'title' => 'User Short-Cut Limit',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 14,
                'title' => 'Offer',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 15,
                'title' => 'Priojon',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 16,
                'title' => 'Gold Short-Cut',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 17,
                'title' => 'Platinum offer',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 18,
                'title' => 'Platinum Short-cuts',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}