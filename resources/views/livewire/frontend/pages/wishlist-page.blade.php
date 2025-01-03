<div>
    <section class="flat-spacing-2">
        <div class="container">
            @if(count($products) === 0)
                <x-empty-state :message="__('Your wishlist is empty.')">
                    <a wire:navigate href="{{ route('products') }}"
                       class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn mt-3">
                        {{ __('Continue Shopping') }}
                    </a>
                </x-empty-state>
            @endif


            <div class="grid-layout wrapper-shop" data-grid="grid-4">
                @foreach($products as $product)
                    <x-card.product :product="$product"/>
                @endforeach
            </div>
        </div>
    </section>
</div>
