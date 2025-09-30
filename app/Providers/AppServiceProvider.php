<?php

namespace App\Providers;

use App\Models\Block;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set global date format for Carbon
        Carbon::macro('toDateString', function () {
            return $this->format('d-m-Y');
        });
        
        Carbon::macro('toDateTimeString', function () {
            return $this->format('d-m-Y H:i:s');
        });
        
        // Set default format for date display
        Carbon::setToStringFormat('d-m-Y');
    }
}