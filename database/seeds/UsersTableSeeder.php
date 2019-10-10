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
            'name' => 'My-bl Admin',
            'role_id' => 1,
            'email' => 'mybl-admin@admin.com',
            'type' => 'mybl',
            'phone' => '0191911111541',
            'uid' => uniqid(),
            'password' =>Hash::make('123456'),
            'device_token' => '122'
        ]);

        DB::table('users')->insert([
            'name' => 'web-admin',
            'role_id' => 2,
            'email' => 'assetlite@admin.com',
            'phone' => '0191941551111',
            'type' => 'assetlite',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' => '122'
        ]);

        DB::table('users')->insert([
            'name' => 'Test',
            'role_id' => 3,
            'email' => 'test@admin.com',
            'phone' => '01919415566',
            'type' => 'mybl',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' =>  "cbccwirrVwU:APA91bEJZkLi9mWV5hh6EjtFFLegw6_f4_eBGlqJ02KnHo7cW4KuyfJZIfQ-_VEDdCr3Kf3Lg9kj9e7ihELO3aHGrlZJxYGsOTPObHjEOLSAJPAOm_KI9QpvQM28wPW0D3BK2MllIMv2"
        ]);

        DB::table('users')->insert([
            'name' => 'Jahidul Islam',
            'role_id' => 4,
            'email' => 'jahidul@admin.com',
            'phone' => '01919415588',
            'type' => 'assetlite',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' =>  "cbccwirrVwU:APA91bEJZkLi9mWV5hh6EjtFFLegw6_f4_eBGlqJ02KnHo7cW4KuyfJZIfQ-_VEDdCr3Kf3Lg9kj9e7ihELO3aHGrlZJxYGsOTPObHjEOLSAJPAOm_KI9QpvQM28wPW0D3BK2MllIMv2"
        ]);


        ////////////////////////////Other users///////////////////////////

        DB::table('users')->insert([
            'name' => 'Rafiqul Hasan',
            'role_id' => 1,
            'email' => 'rafiq@admin.com',
            'phone' => '01919415595',
            'type' => 'mybl',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' =>  "cbccwirrVwU:APA91bEJZkLi9mWV5hh6EjtFFLegw6_f4_eBGlqJ02KnHo7cW4KuyfJZIfQ-_VEDdCr3Kf3Lg9kj9e7ihELO3aHGrlZJxYGsOTPObHjEOLSAJPAOm_KI9QpvQM28wPW0D3BK2MllIMv2"
        ]);


        DB::table('users')->insert([
            'name' => 'Rupok Biswas',
            'role_id' => 1,
            'email' => 'rupok@admin.com',
            'phone' => '01919415565',
            'type' => 'mybl',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' =>  "c3DAuP4BnZQ:APA91bHtwS1dFC9CKZ5MdbSnZvGByhyIxATakCPnUBYWgyJY7L59A70KzBR5DdXlhQ1yVOxxmZcVXdQ_rHUojjB666us6WEo9gFuPCyQOgmTNqYSArVS2kxAWq68iY15_EIYQaKUGSvs"
        ]);

        DB::table('users')->insert([
            'name' => 'QA Team',
            'role_id' => 1,
            'email' => 'qa@admin.com',
            'phone' => '01919415568',
            'type' => 'mybl',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' =>  "d0Z-Mro4aIg:APA91bHXRkkZHxKVWws7cC-T2kWcu6srvLPWswPqd3Lah7EWbPz8sMwBhg5v2Z1c1Vv1glFY3KukwO4EcRUPlVWKrt8iTjoUDOWVcguVs_b2GgVaJRB4vzT4A2relAs09m3WOcv_BOaD"
        ]);
    }
}
