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

        $myblUsers = [
            [
                'name' => 'My-bl Admin',
                'email' => 'mybl-admin@admin.com',
                'type' => 'mybl',
                'phone' => '0191911111541',
                'uid' => uniqid(),
                'password' => Hash::make('123456'),
                'device_token' => '122'
            ],
            [
                'name' => 'Rafiqul Hasan',
                'email' => 'rafiq@admin.com',
                'phone' => '01919415595',
                'type' => 'mybl',
                'uid' => uniqid(),
                'password' => Hash::make('123456'),
                'device_token' =>  "cbccwirrVwU:APA91bEJZkLi9mWV5hh6EjtFFLegw6_f4_eBGlqJ02KnHo7cW4KuyfJZIfQ-_VEDdCr3Kf3Lg9kj9e7ihELO3aHGrlZJxYGsOTPObHjEOLSAJPAOm_KI9QpvQM28wPW0D3BK2MllIMv2"
            ],
            [
                'name' => 'Rupok Biswas',
                'email' => 'rupok@admin.com',
                'phone' => '01919415565',
                'type' => 'mybl',
                'uid' => uniqid(),
                'password' => Hash::make('123456'),
                'device_token' =>  "c3DAuP4BnZQ:APA91bHtwS1dFC9CKZ5MdbSnZvGByhyIxATakCPnUBYWgyJY7L59A70KzBR5DdXlhQ1yVOxxmZcVXdQ_rHUojjB666us6WEo9gFuPCyQOgmTNqYSArVS2kxAWq68iY15_EIYQaKUGSvs"
            ],
            [
                'name' => 'QA Team',
                'email' => 'qa@admin.com',
                'phone' => '01919415568',
                'type' => 'mybl',
                'uid' => uniqid(),
                'password' => Hash::make('123456'),
                'device_token' =>  "d0Z-Mro4aIg:APA91bHXRkkZHxKVWws7cC-T2kWcu6srvLPWswPqd3Lah7EWbPz8sMwBhg5v2Z1c1Vv1glFY3KukwO4EcRUPlVWKrt8iTjoUDOWVcguVs_b2GgVaJRB4vzT4A2relAs09m3WOcv_BOaD"
            ]
        ];

        for ($i = 0; $i < count($myblUsers); $i++) {
            DB::table('users')->insert($myblUsers[$i]);
            DB::table('role_user')->insert(
                [
                'role_id' => 1,
                'user_id' => $i + 1
                ]
            );
        }



        $assetLiteUsers = [
            [
                'name' => 'Asset Lite Super Admin',
                'email' => 'super@admin.com',
                'phone' => '0191941551111',
                'type' => 'assetlite',
                'uid' => uniqid(),
                'password' => Hash::make('123456'),
                'device_token' => '122'
            ],
            [
                'name' => 'Asset Lite Super User',
                'email' => 'super@user.com',
                'phone' => '01919415566',
                'type' => 'assetlite',
                'uid' => uniqid(),
                'password' => Hash::make('123456'),
                'device_token' =>  "cbccwirrVwU:APA91bEJZkLi9mWV5hh6EjtFFLegw6_f4_eBGlqJ02KnHo7cW4KuyfJZIfQ-_VEDdCr3Kf3Lg9kj9e7ihELO3aHGrlZJxYGsOTPObHjEOLSAJPAOm_KI9QpvQM28wPW0D3BK2MllIMv2"
            ],
            [
                'name' => 'Asset Lite Power User',
                'email' => 'power@user.com',
                'phone' => '01919415578',
                'type' => 'assetlite',
                'uid' => uniqid(),
                'password' => Hash::make('123456'),
                'device_token' =>  "cbccwirrVwU:APA91bEJZkLi9mWV5hh6EjtFFLegw6_f4_eBGlqJ02KnHo7cW4KuyfJZIfQ-_VEDdCr3Kf3Lg9kj9e7ihELO3aHGrlZJxYGsOTPObHjEOLSAJPAOm_KI9QpvQM28wPW0D3BK2MllIMv2"
            ],
            [
                'name' => 'Asset Lite User',
                'email' => 'normal@user.com',
                'phone' => '01919415567',
                'type' => 'assetlite',
                'uid' => uniqid(),
                'password' => Hash::make('123456'),
                'device_token' =>  "cbccwirrVwU:APA91bEJZkLi9mWV5hh6EjtFFLegw6_f4_eBGlqJ02KnHo7cW4KuyfJZIfQ-_VEDdCr3Kf3Lg9kj9e7ihELO3aHGrlZJxYGsOTPObHjEOLSAJPAOm_KI9QpvQM28wPW0D3BK2MllIMv2"
            ]
        ];

        // TODO : https://stackoverflow.com/questions/45269146/laravel-seeding-many-to-many-relationship
        for ($i = 0; $i < count($assetLiteUsers); $i++) {
            DB::table('users')->insert($assetLiteUsers[$i]);
            DB::table('role_user')->insert(
                [
                'role_id' => $i + 2,
                'user_id' => count($myblUsers) + $i + 1
                ]
            );
        }
    }
}
