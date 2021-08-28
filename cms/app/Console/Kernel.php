<?php

namespace App\Console;

use App\Console\Commands\ClearThumbnails;
use App\Console\Commands\ExportBranchToXmlConsole;
use App\Console\Commands\UpdateStatusOfJobConsole;
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
        ExportBranchToXmlConsole::class,
        UpdateStatusOfJobConsole::class,
        ClearThumbnails::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Run cron job every day at 23:30 to update (end day)
        $schedule->command('command:update_job_status')->dailyAt("23:30");
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
