<?php

namespace App\Providers;

use App\Services\Auth\SocialAuthProviderFactory;
use App\Services\Auth\SocialAuthProviderInterface;
use App\Services\Product\Cart;
use App\Services\Product\RecentViews;
use App\Services\Product\Wishlist;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Wishlist::class, fn() => new Wishlist());
        $this->app->singleton(RecentViews::class, fn() => new RecentViews());
        $this->app->singleton(Cart::class, fn() => new Cart());
        $this->app->singleton(SocialAuthProviderInterface::class, fn() => SocialAuthProviderFactory::make(request()->route('provider')));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::usePrefetchStrategy('aggressive');
    }
}
