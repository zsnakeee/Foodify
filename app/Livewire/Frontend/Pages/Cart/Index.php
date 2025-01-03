<?php

namespace App\Livewire\Frontend\Pages\Cart;

use App\Models\PromoCode;
use App\Services\Cart\ExtendedCart;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Cart')]
class Index extends Component
{
    protected ExtendedCart $cart;

    public $products = [];

    public $total = 0;

    #[Validate('required|string')]
    public $promoCode = '';

    public $discount = 0;

    public $priceTotal = 0;

    public function __construct()
    {
        $this->cart = app(ExtendedCart::class)->shopping();
        $this->promoCode = $this->cart->content()->first()->promoCode;
    }

    public function render()
    {
        $this->products = $this->cart->products();
        $this->total = $this->cart->totalFloat();
        $this->discount = $this->cart->discountFloat();
        $this->priceTotal = $this->cart->priceTotalFloat();

        return view('livewire.frontend.pages.cart.index');
    }

    public function applyPromoCode(): void
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
        $this->fireCartUpdatedEvent();
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
