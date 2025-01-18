<x-mail::message>
# Order Paid: #{{ $order->number }}

Hello {{ $order->user->name }},

We have received your payment for the order **#{{ $order->number }}**. Below are the details of your order:

## Details:
- **Order Number:** #{{ $order->number }}
- **Total Amount Paid:** {{ format_price($order->total) }}
- **Payment Method:** {{ ucfirst($order->payment_method) }}
- **Order Date:** {{ $order->created_at->format('F j, Y') }}

<x-mail::table>
| Name | Quantity | Price |
| :--- | :---: | :---: |
@foreach($order->details as $item)
| *{{ $item->product->name }}* | {{ $item->quantity }} | {{ format_price($item->price) }} |
@endforeach
</x-mail::table>

<x-mail::button :url="route('invoice', $order)">
View Invoice
</x-mail::button>

If you have any questions or need further assistance, feel free to contact us.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
