<div>
    <section class="flat-spacing-1">
        <div class="container">
            <div class="tf-row-flex">
                <livewire:frontend.pages.products.filter
                    :categories="[]"
                    :brands="$this->brands"
                    :min-price="$this->minPrice"
                    :max-price="$this->maxPrice"
                    :out-of-stock="$this->outOfStockCount"
                    :in-stock-count="$this->inStockCount"
                    :selected-category="$this->category"
                />

                <livewire:frontend.pages.products.product-list :$category/>
            </div>
        </div>
    </section>
</div>
