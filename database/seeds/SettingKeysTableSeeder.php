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
        DB::table('setting_keys')->insert([
            'title' => 'Offer',
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        DB::table('setting_keys')->insert([
            'title' => 'Short Cuts',
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        DB::table('setting_keys')->insert([
            'title' => 'SMS',
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        DB::table('setting_keys')->insert([
            'title' => 'Internet',
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        DB::table('setting_keys')->insert([
            'title' => 'Talk Time',
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
    }
}