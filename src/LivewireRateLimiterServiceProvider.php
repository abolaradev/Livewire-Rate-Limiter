<?php

namespace Abolaradev\LivewireRateLimiter;

use Abolaradev\LivewireRateLimiter\Attributes\RateLimiter;
use Abolaradev\LivewireRateLimiter\Facades\LivewireRateLimiter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;
use Livewire\Livewire;
use ReflectionClass;

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

      
   
        /**
         * Listen for Livewire method calls and check whether the invoked method
         * has the RateLimiter attribute before allowing it to execute.
         *
         * The RateLimiter attribute is resolved and executed before the Livewire
         * action is called, allowing rate limiting to be applied transparently
         * to Livewire actions.
         */
        Livewire::listen(
            'call',
            function (Component $component, string $methodName) {
                $reflaction = new ReflectionClass($component);

                if ($reflaction->hasMethod($methodName)) {
                    $method = $reflaction->getMethod($methodName);
                    $attribute = $method->getAttributes(RateLimiter::class);
                    if (!empty($attribute)) {
                        $attributeInstance = $attribute[0]->newInstance();
                        $attributeInstance->process();
                    }
                }
            }
        );

        
      

        Blade::if('limitation', function(){
              return LivewireRateLimiter::isRateLimited();
        });
       
        /**
         * Merge the package's default configuration with the application's
         * configuration so the package configuration is available even when
         * the configuration file has not been published.
         */
        $this->mergeConfigFrom(
            __DIR__ . '/../config/livewire-rate-limiter.php',
            'livewire-rate-limiter'
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
