@props(['product'])

<div class="box-icon bg_white quickview tf-btn-loading"
     x-data="{ product: {{ $product->attributesForQuickView() }} }"
     x-on:click="$dispatch('quick-view', product)">
    <span class="icon icon-view"></span>
    <span class="tooltip">{{ __('Quick View') }}</span>
</div>
