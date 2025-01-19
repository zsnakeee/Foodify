<?php

namespace App\DTO;

readonly class PaymentDTO
{
    public function __construct(
        public float $amount,
        public string $currency,
        public ?string $order_id = null,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $address = null,
        public ?string $city = null,
        public ?string $postal_code = null,
    ) {}
}
