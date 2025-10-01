<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        
        // Delete expired password reset tokens every minute
        $schedule->call(function () {
            $expiryMinutes = config('auth.passwords.users.expire', 15);
            $expiryTime = now()->subMinutes($expiryMinutes);
            
            \DB::table('password_reset_tokens')
                ->where('created_at', '<', $expiryTime)
                ->delete();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
