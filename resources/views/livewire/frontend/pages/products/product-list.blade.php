<div class="tf-shop-content wrapper-control-shop w-100" wire:init="$set('readyToLoad', true)">
    <div class="meta-filter-shop"></div>
    @if(count($products) === 0)
        <x-empty-state :message="__('There are no products available at the moment.')" wire:loading.remove/>
    @endif

    <div class="grid-layout wrapper-shop" data-grid="grid-4">
        @foreach($products ?? [] as $product)
            <x-card.product :product="$product" wire:loading.class.remove="visible"/>
        @endforeach

        @foreach(range(1, 12) as $i)
            <x-card.product-skeleton wire:loading/>
        @endforeach
    </div>

    @if($products instanceof  \Illuminate\Pagination\LengthAwarePaginator)
        {{ $products->links() }}
    @endif
</div>


