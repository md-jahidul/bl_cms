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
            'password' =>Hash::make('123456'),
            'device_token' => '122'
        ]);
        DB::table('users')->insert([
            'name' => 'mybl-admin',
            'role_id' => 2,
            'email' => 'mybl-admin@admin.com',
            'phone' => '0191911454111',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' => '122'
        ]);
        DB::table('users')->insert([
            'name' => 'web-admin',
            'role_id' => 3,
            'email' => 'web-admin@admin.com',
            'phone' => '0191941551111',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' => '122'
        ]);

        DB::table('users')->insert([
            'name' => 'Rafiqul Hasan',
            'role_id' => 5,
            'email' => 'rafiq@admin.com',
            'phone' => '01919415568',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' =>  "cbccwirrVwU:APA91bEJZkLi9mWV5hh6EjtFFLegw6_f4_eBGlqJ02KnHo7cW4KuyfJZIfQ-_VEDdCr3Kf3Lg9kj9e7ihELO3aHGrlZJxYGsOTPObHjEOLSAJPAOm_KI9QpvQM28wPW0D3BK2MllIMv2"
        ]);

        DB::table('users')->insert([
            'name' => 'Rupok Hasan',
            'role_id' => 5,
            'email' => 'rafiq@admin.com',
            'phone' => '01919415568',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' =>  "c3DAuP4BnZQ:APA91bHtwS1dFC9CKZ5MdbSnZvGByhyIxATakCPnUBYWgyJY7L59A70KzBR5DdXlhQ1yVOxxmZcVXdQ_rHUojjB666us6WEo9gFuPCyQOgmTNqYSArVS2kxAWq68iY15_EIYQaKUGSvs"
        ]);
    }
}
