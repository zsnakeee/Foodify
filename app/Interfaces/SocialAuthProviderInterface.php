<?php

namespace App\Interfaces;

use Laravel\Socialite\Contracts\User as SocialiteUser;

interface SocialAuthProviderInterface
{
    public function redirect();

    public function handleCallback();

    public function findOrCreateUser(SocialiteUser $socialUser);

    public function createUser(SocialiteUser $socialUser);

    public function hasEmailConflictWithDifferentProvider(SocialiteUser $socialUser);
}
