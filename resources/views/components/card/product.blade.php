@props([
    'product' => null,
 ])

<div class="card-product visible" {{ $attributes }}>
    <div class="card-product-wrapper">
        <a @click.prevent="Livewire.navigate('{{ route('products.view', $product) }}')"
           href="{{ route('products.view', $product) }}" class="product-img">
            <img class="lazyload img-product" data-src="{{ $product->image_url }}"
                 src="{{ $product->image_url }}" alt="{{ $product->name }}">
            <img class="lazyload img-hover" data-src="{{ $product->image_url }}"
                 src="{{ $product->image_url }}" alt="{{ $product->name }}">
        </a>
        <div class="list-product-btn absolute-2">
            <x-actions.quick-add-button :product="$product"/>
            <x-actions.wishlist-button :product="$product"/>
            <x-actions.quick-view-button :product="$product"/>
        </div>
    </div>
    <div class="card-product-info">
        <a @click.prevent="Livewire.navigate('{{ route('products.view', $product) }}')"
           href="{{ route('products.view', $product) }}"
           class="title link">
            {{ $product->name }}
        </a>

        @isset($product->currency)
            <span
                class="price">{{ to_money($product->price, $product->currency) }}</span>
        @else
            <span class="price">{{ $product->priceFormatted }}</span>
        @endisset
        {{--        <span class="price">{{  }}</span>--}}
    </div>
</div>
