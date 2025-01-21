<?php

namespace App\Livewire\Frontend\Forms;

use App\Models\PromoCode;
use App\Services\Cart\ExtendedCart;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PromoCodeForm extends Component
{
    #[Validate('required|string')]
    public $promoCode = '';

    protected ExtendedCart $cart;

    public function mount()
    {
        $this->cart = app(ExtendedCart::class)->shopping();
        $this->promoCode = $this->cart->content()->first()?->promoCode ?? '';
    }

    public function render()
    {
        return view('livewire.frontend.forms.promo-code-form');
    }

    public function applyPromoCode(ExtendedCart $cart): void
    {
        $this->validate();

        $promoCode = PromoCode::where('code', $this->promoCode)->first();
        if (! $promoCode) {
            $this->addError('promoCode', __('Promo code not found'));

            return;
        }

        $error = $promoCode->validate();
        if ($error) {
            $this->addError('promoCode', $error);

            return;
        }

        $this->cart->applyPromoCode($promoCode);
        $this->fireCartUpdatedEvent($cart);
    }

    public function removePromoCode(): void
    {
        $this->cart->removePromoCode();
        $this->promoCode = '';
        $this->fireCartUpdatedEvent();
    }

    protected function fireCartUpdatedEvent(): void
    {
        $this->dispatch('cart-updated',
            products: $this->cart->products(),
            total: $this->cart->totalFloat(),
            subTotal: $this->cart->priceTotalFloat(),
            discount: $this->cart->discountFloat(),
        );
    }
}
