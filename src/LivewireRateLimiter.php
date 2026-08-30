<?php

namespace Abolaradev\LivewireRateLimiter;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LivewireRateLimiter
{
    /** Maximum allowed attempts. */
    private int $maxAttempts;

    /** Rate limit decay time in seconds. */
    private int $decaySeconds;

    /** Unique rate limiter key. */
    private string $key;

    /** Seconds until the next attempt is available. */
    private int $availableIn;

    /** Create a new rate limiter instance. */
    public function __construct($maxAttempts = null, $decaySeconds = null)
    {
        $config = config('livewire-rate-limiter');

        $this->maxAttempts = empty($maxAttempts)
                           ? $config['maxAttempts']
                           : $maxAttempts;

        $this->decaySeconds = empty($decaySeconds)
                            ? $config['decaySeconds']
                            : $decaySeconds;

        $this->availableIn=0;
        
        $this->resolveKey();

    }

    /** Configure a rate limiter with custom limits. */
    public function configure(int $maxAttempts, int $decaySeconds): self
    {
        $this->maxAttempts = $maxAttempts;
        $this->decaySeconds = $decaySeconds;

        return $this;
    }

    /** Execute the action if the rate limit allows it. */
    public function handle(Closure $onAction, ?Closure $onLimit = null)  
    {
        $execute = RateLimiter::attempt($this->key,$this->maxAttempts,$onAction, $this->decaySeconds);

        if (! $execute) {
            $this->availableIn = RateLimiter::availableIn($this->key);

            is_callable($onLimit)
                        ? $onLimit()
                        : abort(429);
        }
    }
    

    /** Get the remaining cooldown time in seconds. */
    public function getAvailableIn(): int
    {
        return $this->availableIn;
    }
    
    /**
     * generate rate limiter key
     *
     * @return void
     */
    protected function resolveKey(): void
    {
        $identifier = Auth::check()
            ? 'user:' . Auth::id()
            : 'session:' . session()->getId();

        $this->key = 'livewire-rate-limiter:' . hash(
            'sha256',
            implode('|', [
                $identifier,
                request()->ip(),
            ])
        );
    }
}

