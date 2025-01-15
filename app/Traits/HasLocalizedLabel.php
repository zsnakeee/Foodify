<?php

namespace App\Traits;

use Str;

use function Filament\Support\get_model_label;

trait HasLocalizedLabel
{
    public static function getLabel(): ?string
    {
        return __(static::getModelLabel());
    }

    public static function getModelLabel(): string
    {
        return __(static::getUpperLabel());
    }

    public static function getPluralModelLabel(): string
    {
        return __(static::getPluralLabel());
    }

    public static function getUpperLabel(): string
    {
        return Str::ucfirst(get_model_label(static::$model));
    }

    public static function getPluralLabel(): string
    {
        return Str::ucfirst(Str::plural(get_model_label(static::$model)));
    }
}
