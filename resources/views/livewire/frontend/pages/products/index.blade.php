<div>
    <section class="flat-spacing-1">
        <div class="container">
            <div class="tf-row-flex">
                <livewire:frontend.pages.products.filter
                    :$categories
                    :$brands
                    :$minPrice
                    :$maxPrice
                    :$inStockCount
                    :$outOfStockCount
                />

                <livewire:frontend.pages.products.product-list/>
            </div>
        </div>
    </section>
</div>
