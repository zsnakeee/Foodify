<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum DiscountType: string
{
    use EnumToArray;

    case Fixed = 'fixed';
    case Percentage = 'percentage';
}
