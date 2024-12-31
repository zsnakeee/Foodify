<?php

namespace App\Services\Auth;

use App\Models\User;
use Exception;
use Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Str;

abstract class SocialAuthProvider implements SocialAuthProviderInterface
{
    protected string $provider;

    public function redirect()
    {
        return Socialite::driver($this->provider)->redirect();
    }

    /**
     * @throws Exception
     */
    public function handleCallback()
    {
        $socialUser = Socialite::driver($this->provider)->user();
        $user = $this->findOrCreateUser($socialUser);
        auth()->login($user, true);
    }


    /**
     * @throws Exception
     */
    public function findOrCreateUser(SocialiteUser $socialUser)
    {
        if ($this->hasEmailConflictWithDifferentProvider($socialUser))
            throw new Exception(__('auth.socialite.email_conflict'));

        if ($authUser = User::where('oauth_provider', $this->provider)->where('oauth_id', $socialUser->id)->first())
            return $authUser;

        return $this->createUser($socialUser);
    }

    /**
     * @throws Exception
     */
    public function createUser(SocialiteUser $socialUser)
    {
        if (User::where('email', $socialUser->email)->exists())
            throw new Exception(__('auth.socialite.email_conflict'));

        return User::create([
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'avatar' => $socialUser->avatar,
            'oauth_provider' => $this->provider,
            'oauth_id' => $socialUser->id,
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(24)),
        ]);
    }

    public function hasEmailConflictWithDifferentProvider(SocialiteUser $socialUser)
    {
        return User::where('email', $socialUser->email)
            ->where('oauth_provider', '!=', $this->provider)
            ->exists();
    }
}
