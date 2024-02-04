<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Model\CronSchedule;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
         Commands\ChatCron::class,
         Commands\ClientMigrateDataBase::class,
         Commands\ClientMigrationUpdate::class,
         Commands\DailyPlanCheck::class,
         Commands\SyncCareProviders::class,
         Commands\NotifyUsers::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('curenik:notifyUsers')->everyMinute();
        
        \App\Helpers\Helper::connectByDomain('care_connect_live');
        $crons = CronSchedule::get();
        foreach ($crons as $key => $value) {
            $times = json_decode($value->schedule_at);
            foreach ($times as  $time) {
                if($time)
                    $schedule->command($value->command_name)->dailyAt($time);  
            }
        }
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
