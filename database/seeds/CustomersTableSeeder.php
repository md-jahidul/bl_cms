<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $customers = [
            [
                'name' => 'My-bl Admin',
                'email' => 'mybl-admin@admin.com',
                'phone' => '01919111541',
                'uid' => uniqid(),
                'device_token' => '122'
            ],
            [
                'name' => 'Rafiqul Hasan',
                'email' => 'rafiq@admin.com',
                'phone' => '01921508454',
                'uid' => uniqid(),
                'device_token' =>  "cbccwirrVwU:APA91bEJZkLi9mWV5hh6EjtFFLegw6_f4_eBGlqJ02KnHo7cW4KuyfJZIfQ-_VEDdCr3Kf3Lg9kj9e7ihELO3aHGrlZJxYGsOTPObHjEOLSAJPAOm_KI9QpvQM28wPW0D3BK2MllIMv2"
            ],
            [
                'name' => 'Rupok Biswas',
                'email' => 'rupok@admin.com',
                'phone' => '01913243757',
                'uid' => uniqid(),
                'device_token' =>  "c3DAuP4BnZQ:APA91bHtwS1dFC9CKZ5MdbSnZvGByhyIxATakCPnUBYWgyJY7L59A70KzBR5DdXlhQ1yVOxxmZcVXdQ_rHUojjB666us6WEo9gFuPCyQOgmTNqYSArVS2kxAWq68iY15_EIYQaKUGSvs"
            ],

            [
                'name' => 'Rupok Bishas',
                'email' => 'rupok@admin.com',
                'phone' => '01913243746',
                'uid' => uniqid(),
                'device_token' =>  "c3DAuP4BnZQ:APA91bHtwS1dFC9CKZ5MdbSnZvGByhyIxATakCPnUBYWgyJY7L59A70KzBR5DdXlhQ1yVOxxmZcVXdQ_rHUojjB666us6WEo9gFuPCyQOgmTNqYSArVS2kxAWq68iY15_EIYQaKUGSvs"
            ],

            [
                'name' => 'QA Team',
                'email' => 'qa@admin.com',
                'phone' => '01914758995',
                'uid' => uniqid(),
                'device_token' =>  "d0Z-Mro4aIg:APA91bHXRkkZHxKVWws7cC-T2kWcu6srvLPWswPqd3Lah7EWbPz8sMwBhg5v2Z1c1Vv1glFY3KukwO4EcRUPlVWKrt8iTjoUDOWVcguVs_b2GgVaJRB4vzT4A2relAs09m3WOcv_BOaD"
            ],
            [
                'name' => 'Farzana Eti',
                'email' => 'farzan@admin.com',
                'phone' => '01962852741',
                'uid' => uniqid(),
                'device_token' =>  "d0Z-Mro4aIg:APA91bHXRkkZHxKVWws7cC-T2kWcu6srvLPWswPqd3Lah7EWbPz8sMwBhg5v2Z1c1Vv1glFY3KukwO4EcRUPlVWKrt8iTjoUDOWVcguVs_b2GgVaJRB4vzT4A2relAs09m3WOcv_BOaD"
            ],
            [
                'name' => 'My-bl',
                'email' => 'mybl-admin18@admin.com',
                'phone' => '01940035918',
                'uid' => uniqid(),
                'device_token' => '122'
            ],

            [
                'name' => 'Rafiq',
                'email' => 'mybl-admin18@admin.com',
                'phone' => '01921508455',
                'uid' => uniqid(),
                'device_token' => '122'
            ],


            [
                'name' => 'mybl user',
                'email' => 'mybl-admin43@admin.com',
                'phone' => '01902796143',
                'customer_account_id' => '1591',
                'uid' => uniqid(),
                'device_token' => 'c9LSjMOIATY:APA91bFB9sze2LoPgz1QkMT1GB9TVpwH7UuMYTMiAz0eVVTS0ynkiTZ8VtyQ5NrzebCpUMCt3YFpof-gC2W5rHb0qcnPot8HCtC1RJ_o6oBzpkHA_y5MsYyfgLD0msbWo1PPCQAagHvl'
            ],

            [
                'name' => 'mybl user2',
                'email' => 'mybl-admin42@admin.com',
                'phone' => '01902796142',
                'customer_account_id' => '3553',
                'uid' => uniqid(),
                'device_token' => 'ejtk9Uf-Dz4:APA91bHhl21TrWXd_OT0ATjjfGcmkULEIHgKVvf4f2GX85OuXmPDAO5hKJT0WwEd9RSWxLuSgKdchGOOPo-xCqKhm1_PeZrR1nVOyLX60CkD79iAkdPrd6QeebHnkKHuxi86bvpIa9Cg'
            ],


            [
                'name' => 'Pritom',
                'email' => 'mybl-admin1111@admin.com',
                'phone' => '01911111111',
                'uid' => uniqid(),
                'device_token' => '122'
            ]
        ];

        for ($i = 0; $i < count($customers); $i++) {
            DB::table('customers')->insert($customers[$i]);
        }
    }
}
