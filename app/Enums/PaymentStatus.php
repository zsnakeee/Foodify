<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PaymentStatus: string
{
    use EnumToArray;

    case PAID = 'paid';
    case UNPAID = 'unpaid';

}
