<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'all-admin',
            'role_id' => 1,
            'email' => 'all-admin@admin.com',
            'phone' => '0191911111541',
            'uid' => uniqid(),
            'password' =>Hash::make('123456')
        ]);
        DB::table('users')->insert([
            'name' => 'mybl-admin',
            'role_id' => 2,
            'email' => 'mybl-admin@admin.com',
            'phone' => '0191911454111',
            'uid' => uniqid(),
            'password' => Hash::make('123456')
        ]);
        DB::table('users')->insert([
            'name' => 'web-admin',
            'role_id' => 3,
            'email' => 'web-admin@admin.com',
            'phone' => '0191941551111',
            'uid' => uniqid(),
            'password' => Hash::make('123456')
        ]);
    }
}
