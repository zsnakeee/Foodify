<?php

use App\Livewire\Frontend\Pages\PasswordResetPage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->token = Password::broker()->createToken($this->user);
});

it('renders the password reset page correctly', function () {
    Livewire::test(PasswordResetPage::class)
        ->assertViewIs('livewire.frontend.pages.password-reset-page')
        ->assertSee('Reset Password');
});

it('resets the password successfully', function () {

    Livewire::test(PasswordResetPage::class)
        ->set('email', $this->user->email)
        ->set('password', 'new_password')
        ->set('password_confirmation', 'new_password')
        ->set('token', $this->token)
        ->call('resetPassword')
        ->assertHasNoErrors()
        ->assertRedirect(route('home'));

    expect(Hash::check('new_password', $this->user->fresh()->password))->toBeTrue();
});

it('fails to reset the password with invalid data', function () {
    Livewire::test(PasswordResetPage::class)
        ->set('email', $this->user->email)
        ->set('password', 'short')
        ->set('password_confirmation', 'short')
        ->set('token', $this->token)
        ->call('resetPassword')
        ->assertHasErrors(['password' => 'min']);
});
