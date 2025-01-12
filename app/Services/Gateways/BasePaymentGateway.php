<?php

namespace App\Services\Gateways;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

abstract class BasePaymentGateway
{
    protected string $base_url;

    protected array $header;

    protected string $gateway = 'paypal';

    /**
     * @param  string  $type  json|form_params
     */
    protected function buildRequest(string $url, string $method = 'POST', ?array $data = null, string $type = 'json'): JsonResponse
    {
        try {
            $response = Http::withHeaders($this->header)->send($method, $this->base_url.$url, [
                $type => $data,
            ]);

            return response()->json([
                'success' => true,
                'status' => $response->status(),
                'data' => $response->json(),
            ], $response->status());

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    protected function generateOrderId(): string
    {
        return uniqid().rand(100000, 999999);
    }
}
