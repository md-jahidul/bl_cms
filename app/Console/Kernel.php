<?php

namespace App\Console;

use App\Console\Commands\SyncCustomerDeviceTable;
use App\Console\Commands\SyncCustomersAndCustomersDevicesTable;
use App\Console\Commands\SyncNotificationCategoryTable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SyncCustomerDeviceTable::class,
        SyncCustomersAndCustomersDevicesTable::class,
        SyncNotificationCategoryTable::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notification:schedule')->withoutOverlapping()->everyMinute();
        $schedule->command('flash-hour-reminder:schedule')->withoutOverlapping()->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
