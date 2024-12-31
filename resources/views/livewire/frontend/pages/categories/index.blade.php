<div>
    <section class="flat-spacing-1">
        <div class="container">
            @if($categories->count() === 0)
                <div class="text-center">
                    <i class="fa-solid fa-sad-cry" style="font-size: 60px; color: #c0c0c0;"></i>
                    <h5 class="mt-3"
                        style="color: #c0c0c0;">{{ __('There are no categories available at the moment.') }}</h5>
                </div>
            @else
                <div class="tf-grid-layout lg-col-3 tf-col-2">
                    @foreach($categories as $category)
                        <div class="collection-item hover-img">
                            <div class="collection-inner">
                                <a wire:navigate href="{{ route('categories.view', $category) }}"
                                   class="collection-image img-style text-center    ">
                                    <img class="lazyload" data-src="{{ $category->image_url }}"
                                         style="width: auto; !important;"
                                         src="{{ $category->image_url }}" alt="collection-img">
                                </a>
                                <div class="collection-content mt-2" style="position: initial;">
                                    <a wire:navigate href="{{ route('categories.view', $category) }}"
                                       class="tf-btn collection-title hover-icon"><span>{{ $category->name }}</span><i
                                            class="icon icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $categories->links() }}
            @endif
        </div>
    </section>
</div>
