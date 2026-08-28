<?php

namespace Abolaradev\LivewireRateLimiter;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireRateLimiterServiceProvider extends ServiceProvider
{
     /**
     * Register any application services.
     */
    public function register(): void
    {
  
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Register the package views as a Livewire namespace
        Livewire::addNamespace(
            namespace: 'livewire-rate-limiter',
            viewPath: __DIR__ . '/../resources/views/livewire',
        );

        // Publishing is only available when running from the console
        if (! $this->app->runningInConsole()) {
            return;
        }

        // Publish the package configuration file
        $this->publishes([
            __DIR__.'/../config/livewire-rate-limiter.php' => config_path('livewire-rate-limiter.php'),
        ], ['livewire-rate-limiter', 'livewire-rate-limiter-config']);

    }
}
