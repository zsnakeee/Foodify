<?php

namespace App\Providers;

use App\Services\Cart\ExtendedCart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ExtendedCart::class, fn () => new ExtendedCart($this->app['session'], $this->app['events']));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
