<?php

namespace App\Console;

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
        //
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
        $schedule->command('flash-hour-reminder:schedule')->withoutOverlapping()->everyMinute();
        $schedule->command('product-data:schedule')->withoutOverlapping()->hourly();
        $schedule->command('campaign-modality-reminder:schedule')->withoutOverlapping()->everyMinute();
        $schedule->command('campaign:winner-process')->withoutOverlapping()->hourly();
        $schedule->command('send:rafm-report-cs-sefcare')->withoutOverlapping()
            ->dailyAt(config('constants.cs_selfcare.cs_report_send_at'))
            ->timezone('Asia/Dhaka');
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
