<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\User as SocialiteUser;

it('redirects to the correct Google sign in url', function () {
    $driver = Mockery::mock(GoogleProvider::class);
    $driver->shouldReceive('redirect')
        ->andReturn(new RedirectResponse(route('oauth.callback', 'google')));

    Socialite::shouldReceive('driver')->andReturn($driver);

    $this->get(route('oauth.redirect', 'google'))
        ->assertRedirect(route('oauth.callback', 'google'));
});

it('signs in with Google', function () {
    $socialiteUser = socialiteUser();
    Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);
    $this->get(route('oauth.callback', 'google'))->assertRedirect(route('home'));

    $user = User::where('email', $socialiteUser->email)->first();
    expect(auth()->check())->toBeTrue()
        ->and($user)
        ->avatar->toBe($socialiteUser->avatar)
        ->oauth_provider->toBe('google')
        ->oauth_id->toBe($socialiteUser->id);
});

it('does not sign in with Google if email is already registered with a different provider', function () {
    $socialiteUser = socialiteUser();
    UserFactory::new()->create([
        'email' => $socialiteUser->email,
        'oauth_provider' => 'facebook',
        'oauth_id' => $socialiteUser->id,
    ]);

    Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);
    $this->get(route('oauth.callback', 'google'))
        ->assertRedirect(route('login'))
        ->assertSessionHas('error', __('auth.socialite.email_conflict'));
});
