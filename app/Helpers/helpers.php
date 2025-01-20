<?php

if (! function_exists('exchange')) {
    function exchange($amount, $to = null, $from = null): float
    {
        $to = $to ?? config('app.currency');

        return \App\Models\ExchangeRate::convert($amount, $to, $from);
    }
}

if (! function_exists('format_price')) {
    function format_price($price): string
    {
        $price = exchange($price, config('app.currency'));

        return Number::currency($price, config('app.currency'), app()->getLocale());
    }

    function to_money($price, $currency): string
    {
        return Number::currency($price, $currency, app()->getLocale());
    }
}

if (! function_exists('format_price_')) {

    if (! function_exists('format_phone')) {
        function format_phone($phone): string
        {
            try {
                $phone = phone($phone)->formatInternational();
            } catch (Exception $e) {
            }

            return $phone;
        }
    }
}

if (! function_exists('slug')) {
    function slug($string, $separator = '-'): array|string|null
    {
        if (is_null($string)) {
            return '';
        }

        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", '', $string);
        $string = preg_replace("/[\s-]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }
}

if (! function_exists('ui_avatar')) {
    function ui_avatar($name, $color = '7F9CF5', $background = 'EBF4FF'): string
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color='.$color.'&background='.$background;
    }
}

if (! function_exists('cache_push')) {
    function cache_push($key, $value, $minutes = 60): void
    {
        $values = Cache::get($key, []);
        $values[] = $value;
        Cache::put($key, $values, $minutes);
    }

    function cache_push_unique($key, $value, $minutes = 60): void
    {
        $values = Cache::get($key, []);
        if (! in_array($value, $values)) {
            $values[] = $value;
        }
        Cache::put($key, $values, $minutes);
    }
}
