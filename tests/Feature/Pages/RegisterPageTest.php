<?php

use App\Livewire\Frontend\Pages\RegisterPage;
use Livewire\Livewire;

it('renders the register page correctly', function () {
    Livewire::test(RegisterPage::class)
        ->assertViewIs('livewire.frontend.pages.register-page')
        ->assertSee('Register');
});
