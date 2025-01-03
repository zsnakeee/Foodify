<div class="top-bar-language tf-cur justify-content-end" style="display: flex !important;" x-data>
    <div class="dropdown bootstrap-select image-select style-default">
        <a href="#" class="dropdown-toggle d-flex align-items-center gap-1"
           id="dropdownMenuButton" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            @if(session('currency') === 'USD')
                <img src="{{ asset('assets/images/country/us.svg') }}" alt="us" width="16">
                <span>USD</span>
            @else
                <img src="{{ asset('assets/images/country/eg.svg') }}" alt="eg" width="16">
                <span>EGP</span>
            @endif
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
                <a @class(['dropdown-item', 'active' => session('currency') === 'USD'])
                   x-on:click.prevent="$dispatch('changeCurrency', { currency: 'USD'});">
                    <span class="text">
                        <img src="{{ asset('assets/images/country/us.svg') }}" alt="us">USD $ | United States
                    </span>
                </a>
            </li>

            <li>
                <a @class(['dropdown-item', 'active' => session('currency') === 'EGP'])
                   x-on:click.prevent="$dispatch('changeCurrency', { currency: 'EGP'});">
                    <span class="text">
                        <img src="{{ asset('assets/images/country/eg.svg') }}" alt="eg">EGP LE | Egypt
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <div class="tf-languages">
        <div class="dropdown bootstrap-select image-select center style-default type-languages">
            <a href="javascript:void(0)"
               class="dropdown-toggle d-flex align-items-center gap-1"
               id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <span>{{ app()->getLocale() === 'en' ? 'English' : 'العربية' }}</span>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                    <a @class(['dropdown-item', 'active' => app()->getLocale() === 'en'])
                       x-on:click.prevent=" $dispatch('changeLocale', { locale: 'en'})">
                        <span class="text">English</span>
                    </a>
                </li>

                <li>
                    <a @class(['dropdown-item', 'active' => app()->getLocale() === 'ar'])
                       x-on:click.prevent=" $dispatch('changeLocale', { locale: 'ar'})">
                        <span class="text">العربية</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
