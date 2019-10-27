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
            'created_at' => null,
            'updated_at' => null,
        ]);
        DB::table('setting_keys')->insert([
            'title' => 'Short Cuts',
            'created_at' => null,
            'updated_at' => null,
        ]);
        DB::table('setting_keys')->insert([
            'title' => 'SMS',
            'created_at' => null,
            'updated_at' => null,
        ]);
        DB::table('setting_keys')->insert([
            'title' => 'Internet',
            'created_at' => null,
            'updated_at' => null,
        ]);
        DB::table('setting_keys')->insert([
            'title' => 'Talk Time',
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
