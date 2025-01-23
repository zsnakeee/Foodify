<?php

use App\Livewire\Frontend\Forms\LoginForm;
use App\Livewire\Frontend\Pages\PasswordResetPage;
use App\Models\User;

it('can login', function () {
    $user = \App\Models\User::factory()->create();

    Livewire::test(LoginForm::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login')
        ->assertHasNoErrors()
        ->assertRedirect(route('home'));
});

it('can send password reset link', function () {
    Notification::fake();

    $user = \App\Models\User::factory()->create();

    Livewire::test(LoginForm::class)
        ->set('email', $user->email)
        ->call('recover')
        ->assertHasNoErrors();

    Notification::assertSentTo($user, \Illuminate\Auth\Notifications\ResetPassword::class);
});

it('can recover password', function () {
    $user = User::factory()->create();
    $token = Password::broker()->createToken($user);

    Livewire::test(PasswordResetPage::class)
        ->set('email', $user->email)
        ->set('password', 'new_password')
        ->set('password_confirmation', 'new_password')
        ->set('token', $token)
        ->call('resetPassword')
        ->assertHasNoErrors()
        ->assertRedirect(route('home'));


    expect(Hash::check('new_password', $user->fresh()->password))
        ->toBeTrue();
});
