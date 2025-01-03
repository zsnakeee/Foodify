<div>
    <!-- shoppingCart -->
    <div class="modal fullRight fade modal-shopping-cart" id="shoppingCart"
         wire:ignore.self
         x-data="{ modal: new bootstrap.Modal(document.getElementById('shoppingCart')) }"
         x-on:open-cart.window="!modal._isShown && modal.show();"
        {{--         x-init="!modal._isShown && modal.show()"--}}
        {{--         x-on:cart-updated.window="!modal._isShown && modal.show();"--}}
    >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="header">
                    <div class="title fw-5">{{ __('Shopping cart') }}</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-mini-cart-threshold">
                        <div class="tf-progress-bar">
                            <span style="width: 50%;">
                                <div class="progress-car">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14"
                                         fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M0 0.875C0 0.391751 0.391751 0 0.875 0H13.5625C14.0457 0 14.4375 0.391751 14.4375 0.875V3.0625H17.3125C17.5867 3.0625 17.845 3.19101 18.0104 3.40969L20.8229 7.12844C20.9378 7.2804 21 7.46572 21 7.65625V11.375C21 11.8582 20.6082 12.25 20.125 12.25H17.7881C17.4278 13.2695 16.4554 14 15.3125 14C14.1696 14 13.1972 13.2695 12.8369 12.25H7.72563C7.36527 13.2695 6.39293 14 5.25 14C4.10706 14 3.13473 13.2695 2.77437 12.25H0.875C0.391751 12.25 0 11.8582 0 11.375V0.875ZM2.77437 10.5C3.13473 9.48047 4.10706 8.75 5.25 8.75C6.39293 8.75 7.36527 9.48046 7.72563 10.5H12.6875V1.75H1.75V10.5H2.77437ZM14.4375 8.89937V4.8125H16.8772L19.25 7.94987V10.5H17.7881C17.4278 9.48046 16.4554 8.75 15.3125 8.75C15.0057 8.75 14.7112 8.80264 14.4375 8.89937ZM5.25 10.5C4.76676 10.5 4.375 10.8918 4.375 11.375C4.375 11.8582 4.76676 12.25 5.25 12.25C5.73323 12.25 6.125 11.8582 6.125 11.375C6.125 10.8918 5.73323 10.5 5.25 10.5ZM15.3125 10.5C14.8293 10.5 14.4375 10.8918 14.4375 11.375C14.4375 11.8582 14.8293 12.25 15.3125 12.25C15.7957 12.25 16.1875 11.8582 16.1875 11.375C16.1875 10.8918 15.7957 10.5 15.3125 10.5Z"></path>
                                    </svg>
                                </div>
                            </span>
                        </div>
                        <div class="tf-progress-msg">
                            Buy <span class="price fw-6">$75.00</span> more to enjoy <span
                                class="fw-6">Free Shipping</span>
                        </div>
                    </div>
                    <div class="tf-mini-cart-wrap"
                         wire:ignore.self
                         x-data="shoppingCartHandler(@js($products), '{{ $total }}')"
                         x-on:cart-updated.window="refreshCart($event) ">
                        <div class="tf-mini-cart-main">
                            <div class="tf-mini-cart-sroll">
                                <div class="tf-mini-cart-items">
                                    <template x-for="product in products" :key="product.id">
                                        <div class="tf-mini-cart-item"
                                             x-data="cartHandler(product.id, product.price, product.qty)"
                                             x-init="$watch('quantity', value => updateCart(value));">
                                            <div class="tf-mini-cart-image">
                                                <a wire:navigate :href="`/products/${product.slug}`">
                                                    <img :src="product.img" :alt="product.name">
                                                </a>
                                            </div>
                                            <div class="tf-mini-cart-info">
                                                <a class="title link text-decoration-none" wire:navigate
                                                   :href="`/products/${product.slug}`"
                                                   x-text="product.name"></a>
                                                <a class="meta-variant" wire:navigate
                                                   :href="`/categories/${product.category_slug}`"
                                                   x-text="product.category_name"></a>

                                                <div class="price fw-6" x-text="formattedPrice"></div>
                                                <div class="tf-mini-cart-btns">
                                                    <div class="wg-quantity small">
                                                        <span class="btn-quantity minus-btn"
                                                              x-on:click="decrement();">-</span>
                                                        <input type="text" name="number" x-model="quantity">
                                                        <span class="btn-quantity plus-btn"
                                                              x-on:click="increment();">+</span>
                                                    </div>
                                                    <div x-on:click="removeFromCart"
                                                         class="tf-mini-cart-remove link fs-5 text-decoration-none text-end">
                                                        <span class="icon icon-delete"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>


                                </div>
                            </div>
                        </div>
                        <div class="tf-mini-cart-bottom">
                            <div class="tf-mini-cart-bottom-wrap">
                                <div class="tf-cart-totals-discounts">
                                    <div class="tf-cart-total">Subtotal</div>
                                    <div class="tf-totals-total-value fw-6"
                                         x-text="subTotal">
                                    </div>
                                </div>
                                <div class="tf-cart-tax">Taxes and shipping calculated at checkout</div>
                                <div class="tf-mini-cart-line"></div>
                                <div class="tf-mini-cart-view-checkout">
                                    <a wire:navigate href="{{ route('cart') }}"
                                       class="tf-btn btn-outline radius-3 link w-100 justify-content-center">
                                        {{ __('View cart') }}
                                    </a>
                                    <a href="checkout.html"
                                       class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Check out</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /shoppingCart -->
</div>
