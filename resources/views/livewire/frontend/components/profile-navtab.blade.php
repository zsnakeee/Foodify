<div class="wrap-sidebar-account">
    <ul class="my-account-nav">
        <li>
            <a wire:navigate href="{{ route('orders') }}"
                @class(['my-account-nav-item', 'active' => $tab === 'orders'])>{{ __('Orders') }}</a>
        </li>
        <li>
            <a wire:navigate href="{{ route('addresses') }}"
                @class(['my-account-nav-item', 'active' => $tab === 'addresses'])>{{ __('Addresses') }}</a>
        </li>
        <li>
            <a wire:navigate href="{{ route('profile') }}"
                @class(['my-account-nav-item', 'active' => $tab === 'profile'])>{{ __('Profile') }}</a>
        </li>
        <li>
            <a wire:navigate href="{{ route('wishlist') }}" class="my-account-nav-item">{{ __('Wishlist') }}</a>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="my-account-nav-item">{{ __('Logout') }}</a>
        </li>
    </ul>
</div>
