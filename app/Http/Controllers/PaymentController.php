<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Services\Cart\ExtendedCart;
use App\Factories\PaymentGatewayFactory;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ExtendedCart $cart, Request $request)
    {
        try {
            $gateway = $request->route('gateway');
            $paymentService = PaymentGatewayFactory::make($gateway);
            $result = $paymentService->verify($request);

            if ($result['success']) {
                $order = Order::where('payment_id', $result['payment_id'])->first();
                $order->update(['payment_status' => PaymentStatus::PAID, 'status' => OrderStatus::PROCESSING]);

                return redirect()->route('payment.success', ['order_id' => $order->id]);
            } else {
                return redirect()->route('payment.failure')->with('message', $result['message']);
            }

        } catch (\Exception $e) {
            return redirect()->route('checkout')->error($e->getMessage());
        }
    }
}
