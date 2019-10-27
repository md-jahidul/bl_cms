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
        factory(\App\Models\NotificationCategory::class, 2)->create()->each(function ($c) {

            $c->notifications()->saveMany(
                factory(\App\Models\Notification::class, 2)->make()
            );
        });
    }
}
