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
                'phone' => '0191911111541',
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
