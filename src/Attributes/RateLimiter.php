<?php

namespace Abolaradev\LivewireRateLimiter\Attributes;

use Abolaradev\LivewireRateLimiter\LivewireRateLimiter;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class RateLimiter extends LivewireRateLimiter
{

    /**
     * handle Too Many Requests
     *
     * @return void
     */
    public function process() :void
    {
        $this->handle(onAction: fn()=>true);
    }
}
