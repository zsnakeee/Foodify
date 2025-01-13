<div>
    <section class="flat-spacing-10">
        <div class="container">
            <div class="tf-grid-layout lg-col-2 tf-login-wrap">
                <livewire:frontend.forms.login-form/>
                <div class="tf-login-content">
                    <h5 class="mb_36">{{ __("I'm new here") }}</h5>
                    <p class="mb_20">{{ __("Sign up for early Sale access plus tailored new arrivals, trends and promotions. To
                        opt out, click unsubscribe in our emails") }}.</p>
                    <a wire:navigate href="{{ route('register') }}" class="tf-btn btn-line">
                        {{ __("Register") }}
                        <i class="icon icon-arrow1-top-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

