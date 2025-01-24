<div class="tf-shop-sidebar wrap-sidebar-mobile">
    @if($hasFilters)
        <div class="d-flex justify-content-between align-items-center mb_24">
            <h6 class="">{{ __('Filters') }}</h6>
            <button class="tf-btn style-3 btn-fill animate-hover-btn" wire:click="resetFilters">{{ __('Reset filters') }}</button>
        </div>
    @endif

    @if(count($categories))
        <div class="widget-facet wd-categories">
            <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="true"
                 aria-controls="categories">
                <span>{{ __('Product categories') }}</span>
                <span class="icon icon-arrow-up"></span>
            </div>
            <div id="categories" class="collapse show">
                <ul class="list-categories current-scrollbar mb_36">
                    @foreach($categories as $category)
                        <li @class(['cate-item', 'current' => $selectedCategory == $category['id']])>
                            <a href="javascript:" wire:click="toggleCategory({{ $category['id'] }})">
                                <span>{{ $category['name'] }} ({{ $category['products_count'] }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="facet-filter-form">
        <div class="widget-facet">
            <div class="facet-title" data-bs-target="#availability" data-bs-toggle="collapse" aria-expanded="true"
                 aria-controls="availability">
                <span>{{ __('Availability') }}</span>
                <span class="icon icon-arrow-up"></span>
            </div>
            <div id="availability" class="collapse show">
                <ul class="tf-filter-group current-scrollbar mb_36"
                    x-data="{ availability: @entangle('availability') }"
                    x-init="() => { $watch('availability', value => $wire.set('availability', value)) }">
                    <li class="list-item d-flex gap-12 align-items-center">
                        <input type="radio" name="availability" class="tf-check" id="availability-0"
                               value="all"
                               :class="{ checked: availability === 'all' }"
                               x-model="availability">
                        <label for="availability-0" class="label"><span>{{ __('All') }}</span>&nbsp;<span>({{ $outOfStockCount + $inStockCount }})</span></label>
                    </li>
                    <li class="list-item d-flex gap-12 align-items-center">
                        <input type="radio" name="availability" class="tf-check"
                               :class="{ checked: availability === 'in_stock' }"
                               id="availability-1"
                               value="in_stock"
                               x-model="availability">
                        <label for="availability-1"
                               class="label"><span>{{ __('In stock') }}</span>&nbsp;<span>({{ $inStockCount }})</span></label>
                    </li>
                    <li class="list-item d-flex gap-12 align-items-center">
                        <input type="radio" name="availability" class="tf-check" id="availability-2"
                               :class="{ checked: availability === 'out_of_stock' }"
                               value="out_of_stock"
                               x-model="availability">
                        <label for="availability-2"
                               class="label"><span>{{ __('Out of stock') }}</span>&nbsp;<span>({{ $outOfStockCount }})</span></label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="widget-facet wrap-price">
            <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true"
                 aria-controls="price">
                <span>{{ __('Price') }}</span>
                <span class="icon icon-arrow-up"></span>
            </div>
            <div id="price" class="collapse show">
                <div class="widget-price filter-price">
                    <div class="tow-bar-block" wire:ignore>
                        <div class="progress-price"></div>
                    </div>
                    <div class="range-input">
                        <input class="range-min" type="range" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                               wire:model.live.debounce="selectedMinPrice"
                               value="{{ $selectedMinPrice }}"/>
                        <input class="range-max" type="range" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                               wire:model.live.debounce="selectedMaxPrice"
                               value="{{ $selectedMaxPrice }}"/>
                    </div>
                    <div class="box-title-price">
                        <span class="title-price">{{ __('Price') }} :</span>
                        <div class="caption-price" wire:ignore>
                            <div>
                                <span class="me-1">{{ config('app.currency') }}</span>
                                <span class="min-price">{{ $selectedMinPrice }}</span>
                            </div>
                            <span>-</span>
                            <div>
                                <span class="me-1">{{ config('app.currency') }}</span>
                                <span class="max-price">{{ $selectedMaxPrice }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @if(count($brands))
            <div class="widget-facet">
                <div class="facet-title" data-bs-target="#brand" data-bs-toggle="collapse" aria-expanded="true"
                     aria-controls="brand">
                    <span>{{ __('Brand') }}</span>
                    <span class="icon icon-arrow-up"></span>
                </div>
                <div id="brand" class="collapse show">
                    <ul class="tf-filter-group current-scrollbar mb_36">
                        @foreach($brands as $brand)
                            <li class="list-item d-flex gap-12 align-items-center">
                                <input type="radio" name="brand"
                                       @class(['tf-check', 'checked' => $selectedBrand == $brand['id']])
                                       class="tf-check"
                                       id="brand-{{ $brand['id'] }}"
                                       wire:click="toggleBrand({{ $brand['id'] }})">
                                <label for="brand-{{ $brand['id'] }}"
                                       class="label"><span>{{ $brand['name'] }}</span>&nbsp;<span>({{ $brand['products_count'] }})</span></label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
