<div class="tf-login-form" x-data="{ tab: 'login' }"
     x-init="$watch('tab', () => { document.querySelectorAll('.text-danger').forEach(el => el.textContent = '') })">
    <div x-show="tab === 'recover'"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100">
        <h5 class="mb_24">{{ __('Reset your password') }}</h5>
        <p class="mb_30">{{ __('We will send you an email to reset your password') }}</p>
        <from wire:submit.prevent="recover">
            <div class="tf-field style-1 mb_15">
                <div class="position-relative">
                    <input class="tf-field-input tf-input" placeholder="" type="email"
                           wire:model="email">
                    <label class="tf-field-label fw-4 text_black-2" for="">{{ __('Email') }} *</label>
                </div>

                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="mb_20">
                <button type="button" x-on:click="tab = 'login'"
                        class="tf-btn btn-line">{{ __('Cancel') }}</button>
            </div>
            <div class="">
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">
                    {{ __('Reset password') }}
                </button>
            </div>
        </from>
    </div>
    <div x-show="tab === 'login'"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100">
        <h5 class="mb_36">{{ __('Login') }}</h5>
        <form wire:submit.prevent="login">
            <div class="tf-field style-1 mb_15">
                <div class="position-relative">
                    <input class="tf-field-input tf-input" placeholder="" type="email"
                           wire:model="email">
                    <label class="tf-field-label fw-4 text_black-2" for="">{{ __('Email') }} *</label>
                </div>

                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="tf-field style-1 mb_30">
                <div class="position-relative">
                    <input class="tf-field-input tf-input" placeholder="" type="password"
                           wire:model="password">
                    <label class="tf-field-label fw-4 text_black-2" for="">{{ __('Password') }}
                        *</label>
                </div>

                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="mb_20">
                <button type="button" class="tf-btn btn-line" x-on:click="tab = 'recover'">
                    {{ __('Forgot password?') }}
                </button>
            </div>
            <div class="">
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</div>
