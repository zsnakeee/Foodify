<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PaymentStatus: string
{
    use EnumToArray;

    case PAID = 'paid';
    case UNPAID = 'unpaid';

    public function getName(): string
    {
        return __(ucfirst($this->value));
    }

    public function getBadgeHtml(): string
    {
        return <<<"HTML"
            <span class='badge bg-{$this->getColor()} d-flex gap-1' style="width: fit-content;">
                <i class='fas fa-{$this->getIcon()}'></i> {$this->getName()}
            </span>
            HTML;
    }

    public function getColor(): string
    {
        return match ($this->value) {
            self::PAID->value => 'success',
            default => 'secondary',
        };
    }

    public function getIcon(): string
    {
        return match ($this->value) {
            self::PAID->value => 'check',
            self::UNPAID->value => 'times',
            default => 'question',
        };
    }
}
