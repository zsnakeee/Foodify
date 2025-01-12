<div>
    <section class="flat-spacing-11">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-8">
                    <div class="tf-page-cart-checkout">
                        <div class="d-flex gap-10 align-items-center mb_20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24"
                                 fill="currentColor">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path
                                    d="M15.32 3H8.68c-.26 0-.52.11-.7.29L3.29 7.98c-.18.18-.29.44-.29.7v6.63c0 .27.11.52.29.71l4.68 4.68c.19.19.45.3.71.3h6.63c.27 0 .52-.11.71-.29l4.68-4.68c.19-.19.29-.44.29-.71V8.68c0-.27-.11-.52-.29-.71l-4.68-4.68c-.18-.18-.44-.29-.7-.29zM12 17.3c-.72 0-1.3-.58-1.3-1.3s.58-1.3 1.3-1.3 1.3.58 1.3 1.3-.58 1.3-1.3 1.3zm0-4.3c-.55 0-1-.45-1-1V8c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1z"></path>
                            </svg>
                            <h5 class="fw-5">{{ $title }}</h5>
                        </div>
                        <p class="mb_20">
                            @if(session('message'))
                                {{ session('message') }}
                            @else
                                {{ $message }}
                            @endif
                        </p>
                        <a href="{{ route('checkout') }}"
                           class="tf-btn mb_20 w-100 btn-fill animate-hover-btn radius-3 justify-content-center">
                            <span>{{ __('Back to Checkout') }}</span>
                        </a>
                        <p>{{ __('Have a question?') }} <a href="mailto:{{ config('mail.from.address') }}"
                                                           class="text_primary">{{ __('Contact Support') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
