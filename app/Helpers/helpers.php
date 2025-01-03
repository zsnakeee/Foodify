<?php

if (! function_exists('format_price')) {
    function format_price($price): string
    {
        return Number::currency($price, config('app.currency'), app()->getLocale());
    }
}
