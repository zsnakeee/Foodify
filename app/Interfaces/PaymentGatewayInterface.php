<?php

namespace App\Interfaces;

use App\DTO\PaymentDTO;
use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    public function pay(PaymentDTO $paymentDTO): array;

    public function verify(Request $request);
}
