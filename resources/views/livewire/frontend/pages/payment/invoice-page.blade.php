<div class="invoice-section">
    <div class="cus-container2">
        <div class="top">
            <a href="javascript:" class="tf-btn btn-fill animate-hover-btn" onclick="printInvoice()">
                {{ __('Print this invoice') }}
            </a>
        </div>

        <div class="box-invoice" id="printable-invoice">
            <div class="header">
                <div class="wrap-top">
                    <div class="box-left">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="logo" class="logo">
                        </a>
                    </div>
                    <div class="box-right">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="title">{{ __('Invoice') }} # {{ $order->number }}</div>
                        </div>
                    </div>
                </div>
                <div class="wrap-date">
                    <div class="box-left">
                        <label for="">{{ __('Invoice date') }}</label>
                        <span class="date">{{ $order->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="wrap-info">
                    <div class="box-left">
                        <div class="title">{{ __('From') }}</div>
                        <div class="sub">{{ config('app.name') }}</div>
                    </div>
                    <div class="box-right">
                        <div class="title">{{ __('To') }}</div>
                        <div class="sub">{{ $order->user->name }}</div>
                        <div class="sub">{{ $order->shippingAddress->phone }}</div>
                        <p class="desc">{{ $order->shippingAddress->address }}{{ isset($order->shippingAddress->city) ? ', ' . $order->shippingAddress->city : '' }}</p>
                    </div>
                </div>
                <div class="wrap-table-invoice" style="overflow: auto;">
                    <table class="invoice-table">
                        <thead>
                        <tr class="title">
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->details as $detail)
                            <tr class="content">
                                <td class="text-wrap">{{ $detail->product->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ format_price($detail->price) }}</td>
                                <td></td>
                            </tr>
                        @endforeach

                        <tr class="content">
                            <td class="total">{{ __('Total') }}
                            <td></td>
                            <td></td>
                            <td class="total">{{ format_price($order->total) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="footer">
                <ul class="box-contact">
                    <li>{{ config('app.name') }}</li>
                    <li>{{ config('mail.from.address') }}</li>
                    {{--                    <li>(123) 123-456</li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>

