<div>
    <section class="flat-spacing-11">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-8">
                    <div class="tf-page-cart-checkout">
                        <div class="d-flex gap-10 align-items-center mb_20">
                            <h5 class="fw-5 text-uppercase">{{ $title }}</h5>
                            <i class="fas fa-check-circle text-success fs-2"></i>
                        </div>

                        <p class="mb_20">{{ __('Your order has been successfully placed.') }}</p>
                        @foreach($order->details as $detail)
                            <div class="d-flex justify-content-between align-items-center mb_10 gap-3">
                                <img src="{{ $detail->product->image_url }}"
                                     alt="{{ $detail->product->name }}"
                                     class="img-fluid " style="mix-blend-mode: multiply; width: 50px; height: 50px;">

                                <strong>{{ $detail->product->name }}</strong>
                                <strong>{{ $detail->quantity }} x {{ format_price($detail->price) }}</strong>
                            </div>
                        @endforeach


                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <strong>{{ __('Total') }}</strong>
                            <p>{{ format_price($order->total) }}</p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <strong>{{ __('Shipping address') }}</strong>
                            <p class="text-end">{{ $order->shippingAddress->address }}{{ isset($order->shippingAddress->city) ? ', ' . $order->shippingAddress->city : '' }}</p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <strong>{{ __('Order Status') }}</strong>
                            <p class="text-end">
                                {!! $order->status->getBadgeHtml() !!}

                            </p>
                        </div>

                        <div class="text-center mt-5">
                            <a href="{{ route('invoice', $order->id) }}"
                               class="tf-btn mb_20 w-100 btn-fill animate-hover-btn radius-3 justify-content-center">
                                <span>{{ __('Invoice') }}</span>
                            </a>
                        </div>


                        <p>{{ __('Have a question?') }} <a href="mailto:{{ config('mail.from.address') }}"
                                                           class="text_primary">{{ __('Contact Support') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
