<?php

namespace App\Console;

use App\Console\Commands\ClearDatabaseLog;
use App\Http\Controllers\Admin\AdminEmployeeControllwe;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    

    protected $commands =[
        ClearDatabaseLog::class ,
    ];




    protected function schedule(Schedule $schedule)
    {



        $schedule->call([AdminEmployeeControllwe::class , 'deleteEveryDays'])->everyMinutes();

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
