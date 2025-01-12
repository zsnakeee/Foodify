<div>
    <section class="flat-spacing-11">
        <div class="container">
            @if(!count($products))
                <div class="tf-empty-cart">
                    <div class="empty-cart text-center">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                        </div>

                        <x-empty-state message="{{ __('There are no products in your cart.') }}">
                            <a href="{{ route('home') }}"
                               class="mt-4 tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">{{ __('Return to shop') }}</a>
                        </x-empty-state>
                    </div>
                </div>
            @endif

            @if(count($products))
                <div class="tf-page-cart-wrap layout-2">
                    <div class="tf-page-cart-item">
                        <h5 class="fw-5 mb_20">{{ __('Shipping details') }}</h5>
                        <livewire:frontend.forms.checkout-form :$single/>
                    </div>
                    <div class="tf-page-cart-footer">
                        <div class="tf-cart-footer-inner"
                             wire:ignore.self
                             x-data="{ ...shoppingCartHandler(@js($products), '{{ $total }}'),  discount: '{{ $discount }}', subTotal: '{{ $priceTotal }}' }"
                             x-on:cart-updated.window="refreshCart($event)">
                            <h5 class="fw-5 mb_20">{{ __('Your order') }}</h5>
                            <div class="tf-page-cart-checkout widget-wrap-checkout"
                                 x-data="{gateway: 'paypal', 'termsAccepted': false, 'clicked': false}">
                                <ul class="wrap-checkout-product">
                                    <template x-for="product in products" :key="product.id">
                                        <li class="checkout-product-item">
                                            <figure class="img-product">
                                                <img :src="product.img" :alt="product.name">
                                                <span class="quantity" x-text="product.qty"></span>
                                            </figure>
                                            <div class="content">
                                                <div class="info">
                                                    <p class="name" x-text="product.name"></p>
                                                </div>
                                                <span class="price" x-text="product.formatted_price"></span>
                                            </div>
                                        </li>
                                    </template>
                                </ul>

                                <hr>

                                <livewire:frontend.forms.promo-code-form :single="$single"/>

                                <div class="tf-cart-totals-discounts" x-show="discount > 0">
                                    <h3 class="">{{ __('Subtotal') }}</h3>
                                    <span class="total-value text-decoration-line-through"
                                          x-text="formattedSubTotal"></span>
                                </div>

                                <div class="tf-cart-totals-discounts mt-3" x-show="discount > 0">
                                    <h3 class="">{{ __('Discount') }}</h3>
                                    <span class="total-value" x-text="formattedDiscount"></span>
                                </div>

                                <hr x-show="discount > 0">

                                <div class="tf-cart-totals-discounts mt-2">
                                    <h3 class="">{{ __('Total') }}</h3>
                                    <span class="total-value" x-text="formattedTotal"></span>
                                </div>


                                <div class="wd-check-payment mb_20">
                                    <div class="payment-methods">
                                        <div class="card payment-card" :class="{active: gateway === 'paypal'}"
                                             x-on:click="gateway = 'paypal'">
                                            <div class="card-body text-center ">
                                                <i class="fab fa-paypal fa-3x mb-2" style="color: #003087"></i>
                                                <p class="small">
                                                    {{ __('PAY WITH PAYPAL') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="card payment-card" :class="{active: gateway === 'stripe'}"
                                             x-on:click="gateway = 'stripe'">
                                            <div class="card-body text-center">
                                                <i class="fab fa-stripe fa-3x mb-2" style="color: #6772e5"></i>
                                                <p class="small">
                                                    {{ __('PAY WITH STRIPE') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="card payment-card" :class="{active: gateway === 'cash'}"
                                             x-on:click="gateway = 'cash'">
                                            <div class="card-body text-center">
                                                <i class="fas fa-hand-holding-usd fa-3x mb-2"
                                                   style="color: #4CAF50"></i>
                                                <p class="small">
                                                    {{ __('CASH ON DELIVERY') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                    <p class="text_black-2 mb_20">
                                        {{ __('Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our') }}
                                        <a href="{{-- --}}"
                                           class="text-decoration-underline">{{ __('privacy policy') }}</a>.
                                    </p>
                                    <div class="box-checkbox fieldset-radio">
                                        <input type="checkbox" id="check-agree" class="tf-check"
                                               x-model="termsAccepted">

                                        <label for="check-agree"
                                               class="text_black-2">{{ __('I have read and agree to the') }}
                                            <a href="{{-- --}}"
                                               class="text-decoration-underline">{{ __('terms and conditions') }}</a>.</label>
                                    </div>

                                    <p class="text-danger" style="font-size: 11px" x-show="!termsAccepted && clicked">
                                        {{ __('You must agree to the terms and conditions') }}
                                    </p>


                                </div>
                                <button x-data="{loading: false}"
                                        x-on:click="clicked = true;  if(!termsAccepted) return; loading = true; /*$dispatch('placeOrder', {gateway: gateway});*/ setTimeout(() => loading = false, 1000)"
                                        class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center"
                                        :disabled="loading"

                                        :style="{'pointer-events': loading ? 'none' : 'auto', 'opacity': loading ? 0.5 : 1}">

                                    <span x-show="!loading">{{ __('Place order') }}</span>
                                    <span x-show="loading" class="spinner-border spinner-border-sm" role="status"
                                          aria-hidden="true"></span>
                                </button>
                            </div>


                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
