<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Attributes\Url;
use Livewire\Component;

class ProfileNavtab extends Component
{
    public $tab = 'orders';

    public function render()
    {
        return view('livewire.frontend.components.profile-navtab');
    }
}
