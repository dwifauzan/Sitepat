<?php

namespace App\Console;

use App\Models\datasiswa;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\ResetTelatHourly;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('reset:telat-hourly')->everyMinute();
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            datasiswa::where('kelas_id', '<', 3)->increment('kelas_id');
        })->yearly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
