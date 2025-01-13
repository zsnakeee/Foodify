<div class="my-account-content account-order">
    <div class="wrap-account-order">
        <table>
            <thead>
            <tr>
                <th class="fw-6">{{ __('Order') }}</th>
                <th class="fw-6">{{ __('Date') }}</th>
                <th class="fw-6">{{ __('Status') }}</th>
                <th class="fw-6">{{ __('Payment Status') }}</th>
                <th class="fw-6">{{ __('Total') }}</th>
                <th class="fw-6">{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="tf-order-item">
                    <td>
                        #{{ $order->number }}
                    </td>
                    <td>
                        {{ $order->created_at->translatedFormat('F j, Y') }}
                    </td>
                    <td>
                        {!! $order->status->getBadgeHtml() !!}
                    </td>
                    <td>
                        {!! $order->payment_status->getBadgeHtml() !!}
                    </td>
                    <td>
                        {{ format_price($order->total) }}
                    </td>
                    <td>
                        <a href="{{ route('orders.view', $order) }}"
                           class="tf-btn btn-fill animate-hover-btn rounded-2 btn-sm justify-content-center">
                            <span>{{ __('View') }}</span>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
