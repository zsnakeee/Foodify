<?php

namespace App\Services\Gateways;

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

    public function pay(
        $amount,
        $order_id = null,
        $name = null,
        $email = null,
        $phone = null,
        $address = null,
        $city = null,
        $postal_code = null,
    ): array {

        $order_id = $order_id ?? $this->generateOrderId();
        $data = $this->formatData($amount, $order_id);
        try {
            $response = $this->buildRequest('/v2/checkout/orders', 'POST', $data)->getData(true);

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

    public function formatData($amount, $order_id): array
    {
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
