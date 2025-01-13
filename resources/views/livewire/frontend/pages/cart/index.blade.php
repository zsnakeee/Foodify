<div>
    <!-- page-cart -->
    <section class="flat-spacing-11">
        <div class="container">
            <!-- <div class="tf-page-cart text-center mt_140 mb_200">
                <h5 class="mb_24">Your cart is empty</h5>
                <p class="mb_24">You may check out all the available products and buy some in the shop</p>
                <a href="shop-default.html" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">Return to shop<i class="icon icon-arrow1-top-left"></i></a>
            </div> -->

            <div class="tf-page-cart-wrap"
                 wire:ignore.self
                 x-data="{ ...shoppingCartHandler(@js($products), '{{ $total }}'),  discount: '{{ $discount }}', subTotal: '{{ $priceTotal }}' }"
                 x-on:cart-updated.window="refreshCart($event)">
                <div class="tf-page-cart-item">
                    <form>
                        <table class="tf-table-page-cart">
                            <thead>
                            <tr>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template x-for="product in products" :key="product.id">
                                <tr class="tf-cart-item file-delete"
                                    x-data="cartHandler(product.id, product.price, product.qty)"
                                    x-init="$watch('quantity', value => updateCart(value));">
                                    <td class="tf-cart-item_product">
                                        <a wire:navigate :href="`/products/${product.slug}`" class="img-box">
                                            <img :src="product.img" :alt="product.name" alt="img-product">
                                        </a>
                                        <div class="cart-info">
                                            <a wire:navigate :href="`/products/${product.slug}`" x-text="product.name"
                                               class="cart-title link"></a>
                                            <span class="remove-cart link remove"
                                                  x-on:click="removeFromCart">{{ __('Remove') }}</span>
                                        </div>
                                    </td>
                                    <td class="tf-cart-item_price">
                                        <div class="cart-price" x-text="formattedPrice"></div>
                                    </td>
                                    <td class="tf-cart-item_quantity">
                                        <div class="cart-quantity">
                                            <div class="wg-quantity">
                                                <span class="btn-quantity minus-btn"
                                                      x-on:click="decrement">
                                                    <svg class="d-inline-block" width="9" height="1"
                                                         viewBox="0 0 9 1" fill="currentColor"><path
                                                            d="M9 1H5.14286H3.85714H0V1.50201e-05H3.85714L5.14286 0L9 1.50201e-05V1Z"></path></svg>
                                                </span>
                                                <input type="text" name="number" x-model="quantity">
                                                <span class="btn-quantity plus-btn"
                                                      x-on:click="increment">
                                                    <svg class="d-inline-block" width="9" height="9"
                                                         viewBox="0 0 9 9" fill="currentColor"><path
                                                            d="M9 5.14286H5.14286V9H3.85714V5.14286H0V3.85714H3.85714V0H5.14286V3.85714H9V5.14286Z"></path></svg>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="tf-cart-item_total" cart-data-title="Total">
                                        <div class="cart-total" x-text="formattedTotal"></div>
                                    </td>
                                </tr>
                            </template>

                            <template x-if="!Object.values(products ?? []).length">
                                <tr>
                                    <td colspan="4">
                                        <x-empty-state :message="__('There are no products in your cart.')">
                                            <a href="{{ route('home') }}"
                                               class="mt-4 tf-btn radius-3 bg-body-secondary btn-icon animate-hover-btn justify-content-center">{{ __('Return to shop') }}</a>
                                        </x-empty-state>
                                    </td>
                                </tr>
                            </template>
                            </tbody>
                        </table>

                        <div class="tf-page-cart-note" x-show="products.length">
                            <label for="cart-note">{{ __('Add Order Note') }}</label>
                            <textarea name="note" id="cart-note"
                                      placeholder="{{ __('How can we help you?') }}"></textarea>
                        </div>
                    </form>
                </div>
                <div class="tf-page-cart-footer">
                    <div class="tf-cart-footer-inner">
                        {{--                        <div class="tf-free-shipping-bar">--}}
                        {{--                            <div class="tf-progress-bar">--}}
                        {{--                                    <span style="width: 50%;">--}}
                        {{--                                        <div class="progress-car">--}}
                        {{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="14"--}}
                        {{--                                                 viewBox="0 0 21 14" fill="currentColor">--}}
                        {{--                                                <path fill-rule="evenodd" clip-rule="evenodd"--}}
                        {{--                                                      d="M0 0.875C0 0.391751 0.391751 0 0.875 0H13.5625C14.0457 0 14.4375 0.391751 14.4375 0.875V3.0625H17.3125C17.5867 3.0625 17.845 3.19101 18.0104 3.40969L20.8229 7.12844C20.9378 7.2804 21 7.46572 21 7.65625V11.375C21 11.8582 20.6082 12.25 20.125 12.25H17.7881C17.4278 13.2695 16.4554 14 15.3125 14C14.1696 14 13.1972 13.2695 12.8369 12.25H7.72563C7.36527 13.2695 6.39293 14 5.25 14C4.10706 14 3.13473 13.2695 2.77437 12.25H0.875C0.391751 12.25 0 11.8582 0 11.375V0.875ZM2.77437 10.5C3.13473 9.48047 4.10706 8.75 5.25 8.75C6.39293 8.75 7.36527 9.48046 7.72563 10.5H12.6875V1.75H1.75V10.5H2.77437ZM14.4375 8.89937V4.8125H16.8772L19.25 7.94987V10.5H17.7881C17.4278 9.48046 16.4554 8.75 15.3125 8.75C15.0057 8.75 14.7112 8.80264 14.4375 8.89937ZM5.25 10.5C4.76676 10.5 4.375 10.8918 4.375 11.375C4.375 11.8582 4.76676 12.25 5.25 12.25C5.73323 12.25 6.125 11.8582 6.125 11.375C6.125 10.8918 5.73323 10.5 5.25 10.5ZM15.3125 10.5C14.8293 10.5 14.4375 10.8918 14.4375 11.375C14.4375 11.8582 14.8293 12.25 15.3125 12.25C15.7957 12.25 16.1875 11.8582 16.1875 11.375C16.1875 10.8918 15.7957 10.5 15.3125 10.5Z"></path>--}}
                        {{--                                            </svg>--}}
                        {{--                                        </div>--}}
                        {{--                                    </span>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="tf-progress-msg">--}}
                        {{--                                Buy <span class="price fw-6">$75.00</span> more to enjoy <span class="fw-6">Free Shipping</span>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="tf-page-cart-checkout">
                            <div class="shipping-calculator">
                                <summary
                                    class="accordion-shipping-header d-flex justify-content-between align-items-center collapsed"
                                    data-bs-target="#promo-code" data-bs-toggle="collapse" aria-controls="promo-code">
                                    <h3 class="shipping-calculator-title">{{ __('Promo code') }}</h3>
                                    <span class="shipping-calculator_accordion-icon"></span>
                                </summary>
                                <div class="collapse show" id="promo-code"
                                     wire:ignore.self>
                                    <div class="accordion-shipping-content">
                                        <fieldset class="field">
                                            <label class="label">{{ __('Code') }}</label>
                                            <input type="text" wire:model="promoCode"
                                                   placeholder="{{ __('Enter your promo code') }}"
                                                   class="form-control @error('promoCode') is-invalid @enderror">
                                            @error('promoCode') <span
                                                class="invalid-feedback">{{ $message }}</span> @enderror
                                        </fieldset>

                                        @if($promoCode)
                                            <button
                                                wire:click="removePromoCode"
                                                class="tf-btn animate-hover-btn radius-3 justify-content-center bg-warning">
                                                <span>{{ __('Remove') }}</span>
                                            </button>
                                        @else
                                            <button
                                                wire:click="applyPromoCode"
                                                class="tf-btn btn-fill animate-hover-btn radius-3 justify-content-center">
                                                <span>{{ __('Apply') }}</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

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


                            <div class="cart-checkout-btn">
                                <a href="{{ route('checkout') }}"
                                   class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center">
                                    <span>{{ __('Check out') }}</span>
                                </a>
                            </div>
                            <div class="tf-page-cart_imgtrust">
                                <p class="text-center fw-6">{{ __('Guarantee Safe Checkout') }}</p>
                                <div class="cart-list-social">
                                    <div class="payment-item">
                                        <svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img"
                                             width="38" height="24" aria-labelledby="pi-visa"><title id="pi-visa">
                                                Visa</title>
                                            <path opacity=".07"
                                                  d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path>
                                            <path fill="#fff"
                                                  d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path>
                                            <path
                                                d="M28.3 10.1H28c-.4 1-.7 1.5-1 3h1.9c-.3-1.5-.3-2.2-.6-3zm2.9 5.9h-1.7c-.1 0-.1 0-.2-.1l-.2-.9-.1-.2h-2.4c-.1 0-.2 0-.2.2l-.3.9c0 .1-.1.1-.1.1h-2.1l.2-.5L27 8.7c0-.5.3-.7.8-.7h1.5c.1 0 .2 0 .2.2l1.4 6.5c.1.4.2.7.2 1.1.1.1.1.1.1.2zm-13.4-.3l.4-1.8c.1 0 .2.1.2.1.7.3 1.4.5 2.1.4.2 0 .5-.1.7-.2.5-.2.5-.7.1-1.1-.2-.2-.5-.3-.8-.5-.4-.2-.8-.4-1.1-.7-1.2-1-.8-2.4-.1-3.1.6-.4.9-.8 1.7-.8 1.2 0 2.5 0 3.1.2h.1c-.1.6-.2 1.1-.4 1.7-.5-.2-1-.4-1.5-.4-.3 0-.6 0-.9.1-.2 0-.3.1-.4.2-.2.2-.2.5 0 .7l.5.4c.4.2.8.4 1.1.6.5.3 1 .8 1.1 1.4.2.9-.1 1.7-.9 2.3-.5.4-.7.6-1.4.6-1.4 0-2.5.1-3.4-.2-.1.2-.1.2-.2.1zm-3.5.3c.1-.7.1-.7.2-1 .5-2.2 1-4.5 1.4-6.7.1-.2.1-.3.3-.3H18c-.2 1.2-.4 2.1-.7 3.2-.3 1.5-.6 3-1 4.5 0 .2-.1.2-.3.2M5 8.2c0-.1.2-.2.3-.2h3.4c.5 0 .9.3 1 .8l.9 4.4c0 .1 0 .1.1.2 0-.1.1-.1.1-.1l2.1-5.1c-.1-.1 0-.2.1-.2h2.1c0 .1 0 .1-.1.2l-3.1 7.3c-.1.2-.1.3-.2.4-.1.1-.3 0-.5 0H9.7c-.1 0-.2 0-.2-.2L7.9 9.5c-.2-.2-.5-.5-.9-.6-.6-.3-1.7-.5-1.9-.5L5 8.2z"
                                                fill="#142688"></path>
                                        </svg>
                                    </div>
                                    <div class="payment-item">
                                        <svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" width="38"
                                             height="24" role="img" aria-labelledby="pi-paypal"><title id="pi-paypal">
                                                PayPal</title>
                                            <path opacity=".07"
                                                  d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path>
                                            <path fill="#fff"
                                                  d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path>
                                            <path fill="#003087"
                                                  d="M23.9 8.3c.2-1 0-1.7-.6-2.3-.6-.7-1.7-1-3.1-1h-4.1c-.3 0-.5.2-.6.5L14 15.6c0 .2.1.4.3.4H17l.4-3.4 1.8-2.2 4.7-2.1z"></path>
                                            <path fill="#3086C8"
                                                  d="M23.9 8.3l-.2.2c-.5 2.8-2.2 3.8-4.6 3.8H18c-.3 0-.5.2-.6.5l-.6 3.9-.2 1c0 .2.1.4.3.4H19c.3 0 .5-.2.5-.4v-.1l.4-2.4v-.1c0-.2.3-.4.5-.4h.3c2.1 0 3.7-.8 4.1-3.2.2-1 .1-1.8-.4-2.4-.1-.5-.3-.7-.5-.8z"></path>
                                            <path fill="#012169"
                                                  d="M23.3 8.1c-.1-.1-.2-.1-.3-.1-.1 0-.2 0-.3-.1-.3-.1-.7-.1-1.1-.1h-3c-.1 0-.2 0-.2.1-.2.1-.3.2-.3.4l-.7 4.4v.1c0-.3.3-.5.6-.5h1.3c2.5 0 4.1-1 4.6-3.8v-.2c-.1-.1-.3-.2-.5-.2h-.1z"></path>
                                        </svg>
                                    </div>
                                    <div class="payment-item">
                                        <svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img"
                                             width="38" height="24" aria-labelledby="pi-master"><title id="pi-master">
                                                Mastercard</title>
                                            <path opacity=".07"
                                                  d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path>
                                            <path fill="#fff"
                                                  d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path>
                                            <circle fill="#EB001B" cx="15" cy="12" r="7"></circle>
                                            <circle fill="#F79E1B" cx="23" cy="12" r="7"></circle>
                                            <path fill="#FF5F00"
                                                  d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.3-3 3.4-3 5.7s1.2 4.5 3 5.7c1.8-1.2 3-3.3 3-5.7z"></path>
                                        </svg>
                                    </div>
                                    <div class="payment-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" role="img"
                                             aria-labelledby="pi-american_express" viewBox="0 0 38 24" width="38"
                                             height="24"><title id="pi-american_express">American Express</title>
                                            <path fill="#000"
                                                  d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3Z"
                                                  opacity=".07"></path>
                                            <path fill="#006FCF"
                                                  d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32Z"></path>
                                            <path fill="#FFF"
                                                  d="M22.012 19.936v-8.421L37 11.528v2.326l-1.732 1.852L37 17.573v2.375h-2.766l-1.47-1.622-1.46 1.628-9.292-.02Z"></path>
                                            <path fill="#006FCF"
                                                  d="M23.013 19.012v-6.57h5.572v1.513h-3.768v1.028h3.678v1.488h-3.678v1.01h3.768v1.531h-5.572Z"></path>
                                            <path fill="#006FCF"
                                                  d="m28.557 19.012 3.083-3.289-3.083-3.282h2.386l1.884 2.083 1.89-2.082H37v.051l-3.017 3.23L37 18.92v.093h-2.307l-1.917-2.103-1.898 2.104h-2.321Z"></path>
                                            <path fill="#FFF"
                                                  d="M22.71 4.04h3.614l1.269 2.881V4.04h4.46l.77 2.159.771-2.159H37v8.421H19l3.71-8.421Z"></path>
                                            <path fill="#006FCF"
                                                  d="m23.395 4.955-2.916 6.566h2l.55-1.315h2.98l.55 1.315h2.05l-2.904-6.566h-2.31Zm.25 3.777.875-2.09.873 2.09h-1.748Z"></path>
                                            <path fill="#006FCF"
                                                  d="M28.581 11.52V4.953l2.811.01L32.84 9l1.456-4.046H37v6.565l-1.74.016v-4.51l-1.644 4.494h-1.59L30.35 7.01v4.51h-1.768Z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page-cart -->
</div>
