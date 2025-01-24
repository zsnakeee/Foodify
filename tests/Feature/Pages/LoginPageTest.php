<?php

use App\Livewire\Frontend\Forms\LoginForm;
use App\Livewire\Frontend\Pages\PasswordResetPage;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('renders the login page correctly', function () {
    Livewire::test(LoginForm::class)
        ->assertViewIs('livewire.frontend.forms.login-form')
        ->assertSee('Login');
});

it('can login', function () {
    Livewire::test(LoginForm::class)
        ->set('email', $this->user->email)
        ->set('password', 'password')
        ->call('login')
        ->assertHasNoErrors()
        ->assertRedirect(route('home'));
});

it('can send password reset link', function () {
    Notification::fake();

    Livewire::test(LoginForm::class)
        ->set('email', $this->user->email)
        ->call('recover')
        ->assertHasNoErrors();

    Notification::assertSentTo($this->user, \Illuminate\Auth\Notifications\ResetPassword::class);
});
