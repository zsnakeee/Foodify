<?php

namespace App\Livewire\Frontend\Forms;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class LoginForm extends Component
{
    use Toastable;

    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule(['required', 'string'])]
    public string $password = '';

    #[Rule(['boolean'])]
    public bool $remember = false;

    public function render()
    {
        return view('livewire.frontend.forms.login-form');
    }

    public function login(): void
    {
        $this->validate();
        if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->redirectRoute('home', navigate: true);

            return;
        }

        $this->addError('email', __('auth.failed'));
    }

    public function recover(): void
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $this->only('email')
        );

        $status === Password::RESET_LINK_SENT
            ? $this->success(__('Password reset link sent!'))
            : $this->addError('email', __($status));
    }
}
