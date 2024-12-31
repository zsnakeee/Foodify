<?php

namespace App\Livewire\Frontend\Forms;

use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Rule;
use Livewire\Component;

class LoginForm extends Component
{
    #[Rule(['required', 'email', 'max:255'])]
    public string $email = '';
    #[Rule(['required', 'string'])]
    public string $password = '';
    #[Rule(['boolean'])]
    public bool $remember = false;

    public function render()
    {
        return view('livewire.frontend.forms.login-form');
    }

    public function login()
    {
        $this->validate();
        if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return redirect()->route('frontend.home');
        }
        $this->addError('email', 'These credentials do not match our records.');
    }

    public function logout(): RedirectResponse
    {
        auth()?->logout();
        return redirect()->route('frontend.home');
    }
}
