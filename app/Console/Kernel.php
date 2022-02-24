<?php

namespace App\Console;

use App\Console\Commands\SyncMongoDbCustomersDevicesTable;
use App\Console\Commands\SyncCustomersAndCustomersDevicesTable;
use App\Console\Commands\SyncMongoDbNotificationsCategoriesTable;
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
        SyncMongoDbCustomersDevicesTable::class,
        SyncCustomersAndCustomersDevicesTable::class,
        SyncMongoDbNotificationsCategoriesTable::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notification:schedule')->withoutOverlapping()->everyMinute();
        $schedule->command('redis-reset:schedule')->withoutOverlapping()->everyMinute();
        $schedule->command('flash-hour-reminder:schedule')->withoutOverlapping()->everyMinute();
        $schedule->command('send:rafm-report-cs-sefcare')
                 ->withoutOverlapping()
                 ->dailyAt(config('constants.cs_selfcare.cs_report_send_at'))
                 ->timezone('Asia/Dhaka');
        $schedule->command('mybl-table-sync:mongodb-customers_devices-table')->withoutOverlapping()->everyMinute();
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
