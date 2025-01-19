<?php

namespace App\Models;

use Database\Factories\ExchangeRateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    /** @use HasFactory<ExchangeRateFactory> */
    use HasFactory;

    protected $fillable = [
        'currency',
        'rate',
    ];

    public static function getRate(string $currency): ?float
    {
        $rate = self::where('currency', $currency)->first();

        return $rate?->rate;
    }

    public static function setRate(string $currency, float $rate): void
    {
        $exchangeRate = static::where('currency', $currency)->first();

        if ($exchangeRate) {
            $exchangeRate->update(['rate' => $rate]);
        } else {
            static::create(['currency' => $currency, 'rate' => $rate]);
        }
    }

    public static function convert(float $amount, string $to, ?string $from = null): float
    {
        $from = $from ?? config('app.default_currency');
        if ($from === $to) {
            return $amount;
        }

        $fromRate = self::getRate($from);
        $toRate = self::getRate($to);

        if ($fromRate === null || $toRate === null) {
            throw new \InvalidArgumentException('Invalid currency rate.');
        }

        return round(($amount / $toRate) * $fromRate, 2);
    }
}
