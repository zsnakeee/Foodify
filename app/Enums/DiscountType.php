<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum DiscountType: string
{
    use EnumToArray;

    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';
}
