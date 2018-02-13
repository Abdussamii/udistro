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
        Commands\SendInviteEmail::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
    	// To store the cron output in a file
    	$filePath = storage_path('cron_logs/cron.txt');

    	// Run the cron on every 10 minutes, to run it on terminal try: 
    	// php artisan email:send
    	// php artisan schedule:run
    	
        // $schedule->command('email:send')->everyTenMinutes()->appendOutputTo($filePath);

        $schedule->command('email:send')->everyMinute()->appendOutputTo($filePath);
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
