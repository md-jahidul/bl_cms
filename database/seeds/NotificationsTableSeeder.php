<?php

use Illuminate\Database\Seeder;


class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\NotificationCategory::class, 5)->create()->each(function($c) {

            $c->fixtures()->saveMany(
                factory(\App\Models\Notification::class, 30)->make()
            );
        });
    }
}






