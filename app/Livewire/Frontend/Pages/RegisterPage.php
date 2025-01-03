<?php

namespace App\Livewire\Frontend\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Register')]
class RegisterPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.pages.register-page');
    }
}
