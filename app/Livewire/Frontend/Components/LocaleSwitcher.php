<?php

namespace App\Livewire\Frontend\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class LocaleSwitcher extends Component
{
    public function render()
    {
        return view('livewire.frontend.components.locale-switcher');
    }

    #[On('changeLocale')]
    public function changeLocale($locale): void
    {
        session()->put('locale', $locale);
        Toaster::success(__('Language changed to :locale', ['locale' => $locale]));
        $this->js('$store.locale.set("'.$locale.'"); window.location.reload();');
    }

    #[On('changeCurrency')]
    public function changeCurrency($currency): void
    {
        session()->put('currency', $currency);
        Toaster::success(__('Currency changed to :currency', ['currency' => $currency]));
        $this->js('$store.currency.set("'.$currency.'"); window.location.reload();');
    }
}