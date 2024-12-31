<div>
    <form wire:submit.prevent="register">
        <x-form.input name="name" label="Name *" type="text" required/>
        <x-form.input name="email" label="Email *" type="email" required/>
        <x-form.input name="phone" label="Phone *" type="tel" required/>
        <x-form.input name="password" label="Password *" type="password"/>
        <x-form.input name="password_confirmation" label="Password Confirmation *" type="password" required/>

        <div class="mb_10">
            <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">
                Register
            </button>
        </div>

        <hr class="mb_20"/>


        <div class="mb_20">
            <a href="{{ route('oauth.redirect', 'google') }}"
               class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center"
               style="background-color: #DB4437; border-color: #DB4437;">
               <span class="d-flex justify-content-center gap-2">
                   <i class="fa-brands fa-google"></i>
                   <span class="ml-2">Register with Google</span>
               </span>
            </a>
        </div>

        <div class="text-center">
            <a wire:navigate href="{{ route('login') }}"
               class="tf-btn btn-line">Already have an account? Log in here<i class="icon icon-arrow1-top-left"></i>
            </a>
        </div>

    </form>
</div>
