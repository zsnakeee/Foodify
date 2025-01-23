<div>
    <section class="flat-spacing-10">
        <div class="container">
            <div class="form-register-wrap">
                <div class="flat-title align-items-start gap-0 mb_30 px-0">
                    <h5 class="mb_18">Reset Password</h5>
                    <p class="text_black text-center">Enter your email and new password to reset your password.
                </div>
                <div>
                    <form wire:submit.prevent="resetPassword">
                        <x-form.input name="email" label="Email *" type="email" wire:model="email" disabled/>
                        <x-form.input name="password" label="Password *" type="password" required/>
                        <x-form.input name="password_confirmation" label="Password Confirmation *" type="password"
                                      required/>

                        <div class="mb_10">
                            <button type="submit"
                                    class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">
                                {{ __('Reset Password') }}
                            </button>
                        </div>

                        <hr class="mb_20"/>

                        <div class="text-center">
                            <a wire:navigate href="{{ route('login') }}"
                               class="tf-btn btn-line">{{ __('Login') }}<i class="icon icon-arrow1-top-left"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
