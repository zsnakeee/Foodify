<?php

namespace App\Providers;

use App\Factories\SocialAuthProviderFactory;
use App\Interfaces\SocialAuthProviderInterface;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SocialAuthProviderInterface::class, fn () => SocialAuthProviderFactory::make(request()->route('provider')));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::usePrefetchStrategy('aggressive');
    }
}
