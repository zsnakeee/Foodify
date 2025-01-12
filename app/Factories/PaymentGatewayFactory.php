<?php

namespace App\Factories;

use App\Interfaces\PaymentGatewayInterface;
use Exception;

class PaymentGatewayFactory
{
    /**
     * Make payment gateway instance
     *
     * @throws Exception
     */
    public static function make(string $gateway): PaymentGatewayInterface
    {
        $classNamespace = 'App\Services\Gateways\\'.ucfirst($gateway).'Gateway';
        if (class_exists($classNamespace)) {
            return new $classNamespace;
        }

        throw new Exception('Payment gateway not found');
    }
}
