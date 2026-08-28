<?php

namespace Abolaradev\LivewireRateLimiter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Abolaradev\LivewireRateLimiter\LivewireRateLimiter
 */
class LivewireRateLimiter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Abolaradev\LivewireRateLimiter\LivewireRateLimiter::class;
    }
}
