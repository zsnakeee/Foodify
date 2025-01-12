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
        Toaster::success($locale === 'en' ? 'Language changed to English' : 'تم تغيير اللغة إلى العربية');
        $this->js('$store.locale.set("'.$locale.'");');
        $this->redirect(request()->header('referer'));
    }

    #[On('changeCurrency')]
    public function changeCurrency($currency): void
    {
        session()->put('currency', $currency);
        Toaster::success(__('Currency changed to :currency', ['currency' => $currency]));
        $this->js('$store.currency.set("'.$currency.'");');
        $this->redirect(request()->header('referer'));
    }
}
