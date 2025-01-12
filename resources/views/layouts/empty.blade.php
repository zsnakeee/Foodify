<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ in_array(app()->getLocale(), ['ar', 'he']) ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="eCommerce,shop,fashion">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/logo/favicon.png') }}">

        <title>{{ $title ?? config('app.name') }} {{ $title ? '| ' . config('app.name') : '' }}</title>

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="wrapper-invoice">
        {{ $slot }}
    </body>
</html>
