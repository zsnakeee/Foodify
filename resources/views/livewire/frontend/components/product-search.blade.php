<div>
    <div class="tf-form-search"
         x-data="{ open: false, search: @entangle('search').live, products: @entangle('products').live, isLoading: false }"
         x-init="$watch('search', () => { isLoading = true; $nextTick(() => isLoading = false); })">
        <div class="search-box">
            <input type="text" placeholder="{{ __('Search for products') }}"
                   wire:model.live="search"
                   @focus="open = true" @blur="open = false">
            <button class="tf-btn"><i class="icon icon-search"></i></button>
        </div>

        <div class="search-suggests-results"
             :style="open ? 'opacity: 1; visibility: visible;  pointer-events: all;' : 'opacity: 0; visibility: hidden'">
            <div class="search-suggests-results-inner">
                <ul>
                    <li x-show="search.length === 0 && products?.length === 0">
                        <p class="text-center">{{ __('Type to start searching') }}</p>
                    </li>

                    <!-- Skeleton Loader -->
                    @foreach(range(1, 6) as $index)
                        <li class="search-product-skeleton" wire:loading.block>
                            <div class="search-result-item">
                                <div class="img-box skeleton-box"></div>
                                <div class="box-content">
                                    <p class="title skeleton-box skeleton-text"></p>
                                    <div class="price skeleton-box skeleton-text"></div>
                                </div>
                            </div>
                        </li>
                    @endforeach

                    @forelse($products as $product)
                        <li wire:loading.remove>
                            <a class="search-result-item"
                               x-on:click="$dispatch('add-to-recent-searches', { id: {{ $product->id }} })">
                                <div class="img-box">
                                    <img src="{{ $product->image_url }}" alt="">
                                </div>
                                <div class="box-content">
                                    <p class="title link text_black-2">{{ $product->name }}</p>
                                    <div class="price">{{ $product->formatted_price }}</div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li>
                            <p class="text-center">{{ __('No products found') }}</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
