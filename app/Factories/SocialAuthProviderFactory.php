<?php

namespace App\Factories;

use App\Interfaces\SocialAuthProviderInterface;
use App\Services\Auth\GoogleAuthProvider;
use InvalidArgumentException;

class SocialAuthProviderFactory
{
    public static function make(string $provider): SocialAuthProviderInterface
    {
        return match ($provider) {
            'google' => app(GoogleAuthProvider::class),
            default => throw new InvalidArgumentException(__('auth.socialite.provider_not_supported', ['provider' => $provider])),
        };
    }
}
