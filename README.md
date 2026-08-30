# Livewire Rate Limiter

Rate Limiting is a technique used to control how many requests a user or client can make within a specific period of time. It helps protect applications from excessive requests, abuse, brute-force attempts, and unnecessary resource consumption.

**Livewire Rate Limiter** provides a simple way to apply Rate Limiting to **Livewire Actions** without having to implement the Rate Limiting logic manually.

## Features

* Apply Rate Limiting to Livewire Actions using a PHP Attribute.
* Customize Rate Limiting settings for individual Actions.
* Apply Rate Limiting using the `LivewireRateLimiter` Facade.
* Define custom behavior when the Rate Limit is exceeded.
* Get the remaining time until the Rate Limit expires.
* Display custom content using the `@limitation` Blade directive.
* Automatically return an **HTTP 429 (Too Many Requests)** response when the Rate Limit is exceeded.

## Installation

You can install the package via Composer:

```bash
composer require abolaradev/livewire-rate-limiter
```

You can publish the configuration file with:

```bash
php artisan vendor:publish --tag='livewire-rate-limiter-config'
```

## Configuration

The package configuration is located at `config/livewire-rate-limiter.php`:

```php
return [

    /**
     * Maximum number of allowed attempts within the decay period.
     */
    'maxAttempts' => 10,

    /**
     * Number of seconds before the attempt counter is reset.
     */
    'decaySeconds' => 60,

];
```

## Usage

### Using the `RateLimiter` Attribute

To enable Rate Limiting for a Livewire Action, simply add the `RateLimiter` PHP Attribute to the desired method.

By default, the `RateLimiter` Attribute uses the values defined in the `config/livewire-rate-limiter.php` configuration file.

```php
use Abolaradev\LivewireRateLimiter\Attributes\RateLimiter;
use Livewire\Component;

new class extends Component
{
    #[RateLimiter()]
    public function oneTimePassword()
    {
        $this->send();
    }
};
```

### Custom Rate Limiting

You can customize the Rate Limiting settings for a specific Livewire Action by passing values directly to the `RateLimiter` Attribute.

The `maxAttempts` argument defines the maximum number of allowed attempts, while `decaySeconds` specifies the number of seconds before the attempt counter is reset.

For example, the following Action allows 5 attempts within a 120-second period:

```php
#[RateLimiter(maxAttempts: 5, decaySeconds: 120)]
public function oneTimePassword()
{
    $this->send();
}
```

### Rate Limit Response

When the Rate Limit is exceeded, the package automatically returns an **HTTP 429 (Too Many Requests)** response and prevents the Livewire Action from continuing its execution.

<p align="center">
    <img src="docs/rate-limit.png" alt="Livewire Rate Limiter">
</p>

### Using the `LivewireRateLimiter` Facade

The package also provides an alternative way to apply Rate Limiting to Livewire Actions using the `LivewireRateLimiter` Facade.

Call the `handle` method within the desired Livewire Action. The `onAction` argument accepts a `Closure` containing the logic that should be executed when the request is allowed.

```php
use Abolaradev\LivewireRateLimiter\Facades\LivewireRateLimiter;
use Livewire\Component;

new class extends Component
{
    public function oneTimePassword()
    {
        LivewireRateLimiter::handle(
            onAction: fn () => $this->send()
        );
    }
};
```

### Custom Limit Handling

The Facade-based approach allows you to define custom behavior when the Rate Limit is exceeded.

Pass a `Closure` to the `handle` method using the `onLimit` argument. This Closure is executed when the Rate Limit is exceeded.

```php
public function oneTimePassword()
{
    LivewireRateLimiter::handle(
        onAction: fn () => $this->send(),
        onLimit: fn () => $this->js("alert('Too Many Requests')")
    );
}
```

This allows you to return a custom response or perform any additional process when the Rate Limit is exceeded.

### Getting the Remaining Time

You may need to know how many seconds remain until the current Rate Limit expires. The `getAvailableIn()` method returns the remaining time in seconds.

```php
public int $available;

public function oneTimePassword()
{
    LivewireRateLimiter::handle(
        onAction: fn () => $this->send(),
        onLimit: fn () => $this->available = LivewireRateLimiter::getAvailableIn()
    );
}
```

### Blade Directive

The package also provides a Blade conditional directive called `@limitation`.

It allows you to display custom content while the current Rate Limit is active.

```blade
@limitation
    <p class="text-red-500">
        <span>{{ $available }}</span> seconds remaining until the rate limit expires!
    </p>
@endlimitation
```

If you find this package useful, please don't forget to give it a ⭐ on GitHub. ❤️

## Testing

Run the test suite with:

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) for information on how to report security vulnerabilities.

## Credits

* [abolaradev](https://github.com/abolaradev)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
