<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
            'user_id' => 4,
            'notification_id' => 1,

            ],

            [
                'user_id' => 5,
                'notification_id' => 2,

            ],


            [
            'user_id' => 4,
            'notification_id' => 3,

            ],

            [
                'user_id' => 5,
                'notification_id' => 4,

            ]
        ];

        DB::table('notification_user')->insert($data);
    }
}
