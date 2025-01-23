<?php

namespace App\Livewire\Frontend\Pages;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toastable;
use Str;

#[Layout('layouts.app')]
class PasswordResetPage extends Component
{
    use Toastable;

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required')]
    public string $token = '';

    #[Validate('required|min:8|confirmed')]
    public string $password = '';

    #[Validate('required')]
    public string $password_confirmation = '';

    public function render()
    {
        return view('livewire.frontend.pages.password-reset-page')
            ->layoutData([
                'title' => __('Reset Password'),
                'pageTitle' => __('Reset Password'),
            ]);
    }

    public function resetPassword(): void
    {
        $this->validate();

        $status = Password::reset($this->only('email', 'password', 'password_confirmation', 'token'), function ($user) {
            $user->forceFill([
                'password' => Hash::make($this->password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        });

        if ($status === Password::PASSWORD_RESET) {
            $this->success(__('Password reset successfully!'));
            $this->redirectRoute('home', navigate: true);

            return;
        }

        $this->addError('email', __($status));
    }
}
