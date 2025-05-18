<?php

namespace App\Console;

use App\Http\Controllers\SampahController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    // app/Console/Kernel.php
    protected function schedule(Schedule $schedule)
    {
        // Schedule the Python script execution
        $schedule->call(function () {
            $process = new \Symfony\Component\Process\Process(['python', base_path('ann.py')]);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new \Symfony\Component\Process\Exception\ProcessFailedException($process);
            }
        })->dailyAt('00:00');
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
