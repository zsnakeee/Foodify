<div x-data="{ product: null }"
     x-on:quick-view.window="product = $event.detail; $nextTick(() => new bootstrap.Modal(document.getElementById('quick_view')).show())"
     wire:ignore.self
     class="modal fade modalDemo" id="quick_view">

    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="header">
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            <div class="wrap">
                <div class="tf-product-media-wrap">
                    <div dir="ltr" class="swiper tf-single-slide" style="height: 100%;">
                        <div class="swiper-wrapper" style="height: 100%;">
                            <div class="swiper-slide">
                                <div class="item"
                                     style="height: 100%; display: flex; justify-content: center; align-items: center;">
                                    <img :src="product?.image_url || ''" alt="">
                                </div>
                            </div>

                            <template x-for="image in product?.gallery_urls" :key="image.id">
                                <div class="swiper-slide">
                                    <div class="item">
                                        <img :src="image ?? ''" alt="">
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="swiper-button-next button-style-arrow single-slide-prev"></div>
                        <div class="swiper-button-prev button-style-arrow single-slide-next"></div>
                    </div>
                </div>
                <div class="tf-product-info-wrap position-relative">
                    <div class="tf-product-info-list">
                        <div class="tf-product-info-title">
                            <h6 style="font-size: medium">
                                <a class="text-muted link" wire:navigate :href="product?.category_url || 'javascript:'"
                                   x-text="product?.category || ''"></a>
                            </h6>
                            <h5>
                                <a class="link" wire:navigate :href="product?.url || 'javascript:'"
                                   x-text="product?.name || ''"></a>
                            </h5>
                        </div>

                        <div class="tf-product-description small">
                            <p x-text="product?.description || ''"></p>
                        </div>

                        <div class="tf-product-info-price">
                            <div class="price" x-text="product?.formatted_price || ''"></div>
                        </div>

                        <a wire:navigate :href="product?.url || 'javascript:'"
                           class="tf-btn  justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn w-100 btn-primary">
                            {{ __('See product details') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
