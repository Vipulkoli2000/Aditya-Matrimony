<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\AdvertisementComposer;
use App\View\Composers\TickerComposer;

class ViewComposerServiceProvider extends ServiceProvider
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
        // Register the advertisement composer for the user layout
        View::composer('components.layout.user', AdvertisementComposer::class);
        // Register the ticker composer for the user layout
        View::composer('components.layout.user', TickerComposer::class);
    }
}
