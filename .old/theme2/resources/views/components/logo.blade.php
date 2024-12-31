@props([
    'width' => null,
    'height' => null,
])

<img src="{{ asset('assets/images/logo/logo-main.png') }}" alt="{{ config('app.name') }}"
     width="{{ $width }}"
     height="{{ $height }}" {{ $attributes }}>
