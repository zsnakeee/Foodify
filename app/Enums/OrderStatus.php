<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum OrderStatus: string
{
    use EnumToArray;

    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function getName(): string
    {
        return __(ucfirst($this->value));
    }

    public function getBadgeHtml(): string
    {
        return <<<"HTML"
            <span class='badge bg-{$this->getBadge()} d-flex gap-1'>
                <i class='fas fa-{$this->getIcon()}'></i> {$this->getName()}
            </span>
            HTML;
    }

    public function getColor(): string
    {
        return match ($this->value) {
            self::PENDING->value => 'warning',
            self::PROCESSING->value => 'info',
            self::COMPLETED->value => 'success',
            self::CANCELLED->value => 'danger',
            default => 'secondary',
        };
    }

    public function getIcon(): string
    {
        return match ($this->value) {
            self::PENDING->value => 'clock',
            self::PROCESSING->value => 'cog',
            self::COMPLETED->value => 'check',
            self::CANCELLED->value => 'times',
            default => 'question',
        };
    }

    public function getBadge(): string
    {
        return match ($this->value) {
            self::PENDING->value => 'warning',
            self::PROCESSING->value => 'info',
            self::COMPLETED->value => 'success',
            self::CANCELLED->value => 'danger',
            default => 'secondary',
        };
    }
}
