<?php

namespace App\Livewire\Frontend\Forms;

use Livewire\Attributes\Rule;
use Livewire\Component;

class RegisterForm extends Component
{
    #[Rule(['required', 'string', 'max:255'])]
    public string $name = '';

    #[Rule(['required', 'string', 'email', 'max:255'])]
    public string $email = '';

    #[Rule(['required', 'string', 'min:8', 'confirmed'])]
    public string $password = '';

    #[Rule(['required', 'string', 'min:8'])]
    public string $password_confirmation = '';

    #[Rule(['required', 'phone:mobile'])]
    public string $phone = '';

    public function render()
    {
        return view('livewire.frontend.forms.register-form');
    }

    public function register(): void
    {
        $this->validate();

    }
}
