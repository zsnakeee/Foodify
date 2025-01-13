<div class="wd-form-order">
    <div class="order-head">
        <div class="content">
            {!! $order->status->getBadgeHtml() !!}
            <h6 class="mt-8 fw-5">{{ __('Order') }} #{{ $order->number }}</h6>
        </div>
    </div>
    <div class="tf-grid-layout md-col-2 gap-15">
        <div class="item">
            <div class="text-2 text_black-2">{{ __('Ordered at') }}</div>
            <div class="text-2 mt_4 fw-6">{{ $order->created_at->translatedFormat('F j, Y h:i A') }}</div>
        </div>
        <div class="item">
            <div class="text-2 text_black-2">{{ __('Address') }}</div>
            <div class="text-2 mt_4 fw-6">{{ $order->shippingAddress->full_address }}</div>
        </div>

        <div class="item">
            <div class="text-2 text_black-2">{{ __('Payment Method') }}</div>
            <div class="text-2 mt_4 fw-6">{{ ucfirst($order->payment_method) }}</div>
        </div>

        <div class="item">
            <div class="text-2 text_black-2">{{ __('Payment Status') }}</div>
            <div class="text-2 mt_4 fw-6">{!! $order->payment_status->getBadgeHtml() !!}</div>
        </div>
    </div>

    <hr class="mt-5 mb-3" style="border-top: 1px dashed var(--line); opacity: 1;"/>

    <div class="">
        <h6 class="fw-5 mb-3">{{ __('Items') }}</h6>

        @foreach($order->details as $detail)
            <div class="order-head">
                <figure class="img-product">
                    <img src="{{ $detail->product->image_url }}" alt="{{ $detail->product->name }}">
                </figure>
                <div class="content">
                    <div class="text-2 fw-6">{{ $detail->product->name }} </div>
                    <div class="mt_4"><span class="fw-6">{{ __('Price') }} :</span> {{ format_price($detail->price) }}
                    </div>
                    <div class="mt_4"><span
                            class="fw-6">{{ __('Quantity') }} :</span> {{ Number::forHumans($detail->quantity )}}</div>
                </div>
            </div>
        @endforeach

        <ul>
            <li class="d-flex justify-content-between text-2">
                <span>{{ __('Total Price') }}</span>
                <span class="fw-6">{{ format_price($order->total) }}</span>
            </li>
            <li class="d-flex justify-content-between text-2 mt_4 pb_8 line">
                <span>{{ __('Total Discounts') }}</span>
                <span class="fw-6">{{ format_price($order->discount) }}</span>

            </li>
            <li class="d-flex justify-content-between text-2 mt_8">
                <span>{{ __('Order Total') }}</span>
                <span class="fw-6">{{ format_price($order->total - $order->discount) }}</span>
            </li>
        </ul>
    </div>
</div>
