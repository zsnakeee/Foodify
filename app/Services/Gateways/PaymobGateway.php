<?php

namespace App\Services\Gateways;

use App\DTO\PaymentDTO;
use App\Interfaces\PaymentGatewayInterface;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Log;
use Str;

class PaymobGateway extends BasePaymentGateway implements PaymentGatewayInterface
{
    protected string $public_key;

    protected string $secret_key;

    protected string $hmac;

    protected string $currency;

    protected string $gateway = 'paymob';

    public function __construct()
    {
        $this->public_key = config('services.paymob.public_key');
        $this->secret_key = config('services.paymob.secret_key');
        $this->hmac = config('services.paymob.hmac');
        $this->currency = config('app.currency');
        $this->base_url = 'https://accept.paymob.com';
        $this->header = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Token $this->secret_key",
        ];
    }

    public function pay(PaymentDTO $paymentDTO): array
    {
        try {
            $data = $this->formatData($paymentDTO->order_id);
            $response = $this->buildRequest('/v1/intention/', data: $data)->getData(true);

            Log::info('Paymob pay', $response);
            return [
                'success' => true,
                'payment_id' => $response['data']['intention_order_id'],
                'url' => "$this->base_url/unifiedcheckout/?publicKey=$this->public_key&clientSecret={$response['data']['client_secret']}",
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => $e,
            ];
        }
    }

    public function verify(Request $request): array
    {
        Log::info('Paymob verify', $request->all());
        try {
            $keys = [
                'amount_cents', 'created_at', 'currency', 'error_occured',
                'has_parent_transaction', 'id', 'integration_id', 'is_3d_secure',
                'is_auth', 'is_capture', 'is_refunded', 'is_standalone_payment',
                'is_voided', 'order', 'owner', 'pending', 'source_data_pan',
                'source_data_sub_type', 'source_data_type', 'success',
            ];

            $concat = implode('', array_map(fn ($key) => $request->get($key), $keys));
            $hash = hash_hmac('sha512', $concat, $this->hmac);

            Log::info('Paymob verify hash', [
                'concat' => $concat,
                'hash' => $hash,
                'request' => $request->all(),
            ]);
            if (! hash_equals($hash, $request->get('hmac'))) {
                return [
                    'success' => false,
                    'message' => __('Invalid request'),
                ];
            }

            // success handling
            if ($request->get('success') === 'true') {
                return [
                    'success' => true,
                    'payment_id' => $request->get('order'),
                    'message' => __('Operation completed successfully'),
                    'data' => $request->all(),
                ];
            }

            return [
                'success' => false,
                'message' => __('An error occurred while executing the operation'),
                'data' => $request->all(),
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => $e,
            ];
        }
    }

    public function formatData($order_id): array
    {

        $total = 0;
        $items = [];
        $order = Order::find($order_id);
        foreach ($order->details as $detail) {
            $amount = $this->amount($detail->price, $order->currency);
            $total += $amount * $detail->quantity;
            $items[] = [
                'name' => Str::limit($detail->product->name, 40),
                'description' => $detail->product->description,
                'amount' => $amount,
                'quantity' => $detail->quantity,
            ];
        }

        [$first_name, $last_name] = explode(' ', $order->user->name, 2);

        return [
            'amount' => max($total, $this->amount($order->total, $order->currency)),
            'currency' => $order->currency,
            'payment_methods' => $this->methods(),
            'items' => $items,
            'billing_data' => [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $order->user->email,
                'phone_number' => $order->user->phone,
                'street' => $order->shippingAddress->address,
            ],
            'customer' => [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $order->user->email,
            ],
            'redirection_url' => route('api.payment.callback', ['gateway' => $this->gateway]),
        ];
    }

    protected function amount($amount, $currency): int
    {
        return exchange($amount, to: $this->currency, from: $currency) * 100;
    }

    protected function methods(): array
    {
        $methods = config('services.paymob.integration_id');
        $methods = explode(',', $methods);

        return array_map(fn ($method) => is_numeric($method) ? (int) $method : $method, $methods);
    }
}
