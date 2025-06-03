<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Message;

class TestMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email configuration and send a test email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Log the mail configuration
        $this->info('Testing mail configuration...');
        
        // Get configuration values
        $mailConfig = [
            'driver' => config('mail.default'),
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'username' => config('mail.mailers.smtp.username'),
            'password' => str_repeat('*', strlen(config('mail.mailers.smtp.password'))),
            'encryption' => config('mail.mailers.smtp.encryption'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
        ];
        
        // Log the configuration values
        $this->table(['Setting', 'Value'], collect($mailConfig)->map(function($value, $key) {
            return [$key, $value ?: 'null'];
        })->toArray());
        
        // Get environment variables
        $envVars = [
            'MAIL_MAILER' => env('MAIL_MAILER'),
            'MAIL_HOST' => env('MAIL_HOST'),
            'MAIL_PORT' => env('MAIL_PORT'),
            'MAIL_USERNAME' => env('MAIL_USERNAME'),
            'MAIL_PASSWORD' => str_repeat('*', strlen(env('MAIL_PASSWORD'))),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
            'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
        ];
        
        // Log the environment variables
        $this->info('\nEnvironment Variables:');
        $this->table(['Variable', 'Value'], collect($envVars)->map(function($value, $key) {
            return [$key, $value ?: 'null'];
        })->toArray());
        
        // Ask for an email to send the test to
        $email = $this->ask('Enter an email address to send a test email to');
        
        try {
            // Send a test email
            Mail::raw('This is a test email from your Matrimony application to verify mail configuration.', function (Message $message) use ($email) {
                $message->to($email)
                    ->subject('Test Email from Matrimony App');
            });
            
            $this->info("\nTest email sent to {$email}. Please check your inbox.");
            Log::info("Test email sent to {$email}");
        } catch (\Exception $e) {
            $this->error("\nFailed to send test email: {$e->getMessage()}");
            Log::error("Failed to send test email", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
