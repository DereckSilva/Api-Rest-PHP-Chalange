<?php

namespace App\Console;

use App\Jobs\DownloadFiles;
use App\Jobs\GetZipFile;
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
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(DownloadFiles::dispatch('https://challenges.coode.sh/food/data/json/index.txt',
        '/openFood/products.txt'));

        $schedule->job(GetZipFile::dispatch('https://challenges.coode.sh/food/data/json/',
        '/var/www/html/storage/app/openFood/products.txt'));
       // $schedule->command('exclui:arquivo')->cron('* * * * *');
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
