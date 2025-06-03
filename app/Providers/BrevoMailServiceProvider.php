<?php

namespace App\Providers;

use Illuminate\Mail\MailManager;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;

class BrevoMailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->afterResolving(MailManager::class, function (MailManager $manager) {
            $manager->extend('brevo', function (array $config) {
                $apiKey = $config['key'] ?? env('BREVO_API_KEY');
                
                if (!$apiKey) {
                    throw new \Exception('Brevo API key is required.');
                }
                
                $factory = new BrevoTransportFactory();
                return $factory->create(new Dsn(
                    'brevo+api',
                    'default',
                    $apiKey
                ));
            });
        });
    }
}
