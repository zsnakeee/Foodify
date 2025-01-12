<div class="shipping-calculator">
    <summary
        class="accordion-shipping-header d-flex justify-content-between align-items-center collapsed"
        data-bs-target="#promo-code" data-bs-toggle="collapse" aria-controls="promo-code">
        <h3 class="shipping-calculator-title">{{ __('Promo code') }}</h3>
        <span class="shipping-calculator_accordion-icon"></span>
    </summary>
    <div class="collapse show" id="promo-code"
         wire:ignore.self>
        <div class="coupon-box mt-4">
            <input type="text" wire:model="promoCode"
                   class="form-control @error('promoCode') is-invalid @enderror"
                   placeholder="{{ __('Promo code') }}">

            @if($promoCode)
                <button
                    wire:click="removePromoCode"
                    class="tf-btn animate-hover-btn radius-3 justify-content-center bg-warning">
                    <span>{{ __('Remove') }}</span>
                </button>
            @else
                <button
                    wire:click="applyPromoCode"
                    class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">{{ __('Apply') }}</button>
            @endif
        </div>
    </div>
</div>
