<!-- Footer -->
<footer id="footer" class="footer md-pb-70">
    <div class="footer-wrap">
        <div class="footer-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="footer-infor">
                            <div class="footer-logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset("assets/images/logo/fodify.png") }}"
                                         width="150"
                                         alt="{{ config('app.name') }}"
                                         class="logo">
                                </a>
                            </div>
                            <ul>
                                <li>
                                    <p>{{ __('Address') }}: {{ __('Alexandra, Egypt') }}</p>
                                </li>
                                <li>
                                    <p>{{ __('Email') }}: <a
                                            href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
                                    </p>
                                </li>
                                <li>
                                    <p>{{ __('Phone') }}: <a href="tel:{{ phone('+201127070346') }}"
                                                             style="direction: ltr">{{ phone('+201127070346') }}</a></p>
                                </li>
                            </ul>
                            <a href="javascript:" class="tf-btn btn-line">{{ __('Get direction') }}<i
                                    class="icon icon-arrow1-top-left"></i></a>
                            <ul class="tf-social-icon d-flex gap-10">
                                <li><a href="#" class="box-icon w_34 round social-facebook social-line"><i
                                            class="icon fs-14 icon-fb"></i></a></li>
                                <li><a href="#" class="box-icon w_34 round social-twiter social-line"><i
                                            class="icon fs-12 icon-Icon-x"></i></a></li>
                                <li><a href="#" class="box-icon w_34 round social-instagram social-line"><i
                                            class="icon fs-14 icon-instagram"></i></a></li>
                                <li><a href="#" class="box-icon w_34 round social-tiktok social-line"><i
                                            class="icon fs-14 icon-tiktok"></i></a></li>
                                <li><a href="#" class="box-icon w_34 round social-pinterest social-line"><i
                                            class="icon fs-14 icon-pinterest-1"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12 footer-col-block">
                        <div class="footer-heading footer-heading-desktop">
                            <h6>{{ __('Help') }}</h6>
                        </div>
                        <div class="footer-heading footer-heading-moblie">
                            <h6>{{ __('Help') }}</h6>
                        </div>
                        <ul class="footer-menu-list tf-collapse-content">
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('Privacy Policy') }}</a>
                            </li>
                            <li>
                                <a href="javascript:" class="footer-menu_item"> {{ __('Returns + Exchanges') }} </a>
                            </li>
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('Shipping') }}</a>
                            </li>
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('Terms and conditions') }}</a>
                            </li>
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('FAQ’s') }}</a>
                            </li>
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('Compare') }}</a>
                            </li>
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('My Wishlist') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12 footer-col-block">
                        <div class="footer-heading footer-heading-desktop">
                            <h6>{{ __('About us') }}</h6>
                        </div>
                        <div class="footer-heading footer-heading-moblie">
                            <h6>{{ __('About us') }}</h6>
                        </div>
                        <ul class="footer-menu-list tf-collapse-content">
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('Our Story') }}</a>
                            </li>
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('Visit Our Store') }}</a>
                            </li>
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('Contact Us') }}</a>
                            </li>
                            <li>
                                <a href="javascript:" class="footer-menu_item">{{ __('Account') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="footer-newsletter footer-col-block">
                            <div class="footer-heading footer-heading-desktop">
                                <h6>{{ __('Sign Up for Email') }}</h6>
                            </div>
                            <div class="footer-heading footer-heading-moblie">
                                <h6>{{ __('Sign Up for Email') }}</h6>
                            </div>
                            <div class="tf-collapse-content">
                                <div
                                    class="footer-menu_item"{{ __('Sign up for our newsletter and be the first to know about coupons and special promotions.') }}
                            </div>
                            <form class="form-newsletter" accept-charset="utf-8" data-mailchimp="true">
                                <div x-data="{ email: '' }">
                                    <fieldset class="email">
                                        <input type="email"
                                               x-model="email"
                                               placeholder="{{ __('Enter your email....') }}"
                                               tabindex="0"
                                               aria-required="true">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn"
                                                x-on:click.prevent="$dispatch('subscribe', { email: email })"
                                                x-on:keydown.enter.prevent="$dispatch('subscribe', { email: email })"
                                                x-on-subscribed="email = ''"
                                                type="button">{{ __('Subscribe') }}<i
                                                class="icon icon-arrow1-top-left"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="subscribe-msg"></div>
                            </form>

                            <livewire:frontend.components.locale-switcher/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div
                        class="footer-bottom-wrap d-flex gap-20 flex-wrap justify-content-between align-items-center">
                        <div class="footer-menu_item">
                            {{ __('© :year :name. All Rights Reserved.', ['year' => date('Y'), 'name' => config('app.name')]) }}
                        </div>
                        <div class="tf-payment">
                            <img src="{{ asset("assets/images/payments/visa.png") }}" alt="">
                            <img src="{{ asset("assets/images/payments/img-1.png") }}" alt="">
                            <img src="{{ asset("assets/images/payments/img-2.png") }}" alt="">
                            <img src="{{ asset("assets/images/payments/img-3.png") }}" alt="">
                            <img src="{{ asset("assets/images/payments/img-4.png") }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /Footer -->
