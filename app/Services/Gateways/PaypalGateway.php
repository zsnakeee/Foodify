<?php

namespace App\Services\Gateways;

use App\DTO\PaymentDTO;
use App\Interfaces\PaymentGatewayInterface;
use Exception;
use Illuminate\Http\Request;

class PaypalGateway extends BasePaymentGateway implements PaymentGatewayInterface
{
    protected string $client_id;

    protected string $client_secret;

    protected string $currency;

    public function __construct()
    {
        $this->client_id = config('services.paypal.client_id');
        $this->client_secret = config('services.paypal.client_secret');
        $this->currency = config('services.paypal.currency');
        $this->base_url = config('services.paypal.mode') == 'sandbox' ? 'https://api.sandbox.paypal.com' : 'https://api.paypal.com';
        $this->header = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.base64_encode("$this->client_id:$this->client_secret"),
        ];
    }

    public function pay(PaymentDTO $paymentDTO): array
    {
        $order_id = $paymentDTO->order_id ?? $this->generateOrderId();
        $data = $this->formatData($paymentDTO->amount, $paymentDTO->currency, $order_id);
        try {
            $response = $this->buildRequest('/v2/checkout/orders', 'POST', $data)->getData(true);

            if (isset($response['data']['error']) || $response['status'] != 200) {
                return [
                    'success' => false,
                    'message' => $response['data']['error'] ?? $response['data']['message'] ?? __('An error occurred while executing the operation'),
                    'data' => $response,
                ];
            }

            return [
                'success' => true,
                'payment_id' => $response['data']['id'],
                'url' => $response['data']['links'][1]['href'],
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
        $order_id = $request->query('token');
        try {
            $response = $this->buildRequest("/v2/checkout/orders/$order_id/capture")->getData(true);
            $completed = $response['status'] == 201 && $response['data']['status'] == 'COMPLETED';

            return [
                'success' => $completed,
                'payment_id' => $order_id,
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

    public function formatData($amount, $currency, $order_id): array
    {
        if ($currency !== $this->currency) {
            $amount = exchange($amount, to: $this->currency, from: $currency);
        }

        return [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $order_id,
                    'amount' => [
                        'currency_code' => $this->currency,
                        'value' => $amount,
                    ],
                ],
            ],
            'payment_source' => [
                'paypal' => [
                    'experience_context' => [
                        'return_url' => request()->getSchemeAndHttpHost()."/api/payment/callback/{$this->gateway}",
                        'cancel_url' => route('payment.failure'),
                    ],
                ],
            ],
        ];
    }
}
