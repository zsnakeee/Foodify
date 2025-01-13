<?php

namespace App\Services\Gateways;

use App\DTO\PaymentDTO;
use App\Interfaces\PaymentGatewayInterface;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class StripeGateway extends BasePaymentGateway implements PaymentGatewayInterface
{
    protected string $key;

    protected string $secret;

    protected string $currency;

    protected string $gateway = 'stripe';

    public function __construct()
    {
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
        $this->currency = config('services.stripe.currency');
        $this->base_url = 'https://api.stripe.com';
        $this->header = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => "Bearer $this->secret",
        ];
    }

    public function pay(PaymentDTO $paymentDTO): array
    {
        try {
            $data = $this->formatData($paymentDTO->order_id);
            $response = $this->buildRequest('/v1/checkout/sessions', data: $data, type: 'form_params')->getData(true);
            if (isset($response['data']['error'])) {
                return [
                    'success' => false,
                    'message' => $response['data']['error']['type'],
                    'data' => $response,
                ];
            }

            return [
                'success' => true,
                'payment_id' => $response['data']['id'],
                'url' => $response['data']['url'],
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
        $session_id = $request->get('session_id');
        try {
            $response = $this->buildRequest("/v1/checkout/sessions/$session_id", 'GET')->getData(true);
            $completed = $response['success'] && $response['data']['payment_status'] === 'paid';

            return [
                'success' => $completed,
                'payment_id' => $response['data']['id'],
                'message' => $completed ? __('Operation completed successfully') : __('An error occurred while executing the operation'),
                'data' => $response,
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
        $items = [];
        $order = Order::find($order_id);
        foreach ($order->details as $detail) {
            $items[] = [
                'price_data' => [
                    'currency' => $this->currency,
                    'product_data' => [
                        'name' => $detail->product->name,
                        'description' => $detail->product->description,
                    ],
                    'unit_amount' => $detail->price * 100,
                ],
                'quantity' => $detail->quantity,
            ];
        }

        return [
            'mode' => 'payment',
            'currency' => $this->currency,
            'success_url' => request()->getSchemeAndHttpHost()."/api/payment/callback/{$this->gateway}?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('payment.failure'),
            'line_items' => $items,
        ];
    }
}
