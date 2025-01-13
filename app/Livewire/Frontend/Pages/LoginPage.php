<?php

namespace App\Livewire\Frontend\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class LoginPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.pages.login-page')
            ->layoutData([
                'title' => __('Login'),
                'pageTitle' => __('Login'),
            ]);
    }
}
