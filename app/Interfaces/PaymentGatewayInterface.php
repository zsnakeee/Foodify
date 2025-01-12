<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    public function pay(
        $amount,
        $order_id = null,
        $name = null,
        $email = null,
        $phone = null,
        $address = null,
        $city = null,
        $postal_code = null,
    ): array;

    public function verify(Request $request);
}
