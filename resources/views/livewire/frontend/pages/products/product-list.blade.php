<div class="tf-shop-content wrapper-control-shop w-100" wire:init="$set('readyToLoad', true)">
    <div class="meta-filter-shop"></div>
    @if(count($products) === 0)
        <div class="text-center " wire:loading.remove>
            <i class="fa-solid fa-sad-cry" style="font-size: 60px; color: #c0c0c0;"></i>
            <h5 class="mt-3"
                style="color: #c0c0c0;">{{ __('There are no products available at the moment.') }}</h5>
        </div>
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


