@props([
    'message' => __('No data available.'),
    'icon' => 'fa-solid fa-sad-tear',
    'color' => '#c0c0c0',
    'font' => '60px',
])

<div class="text-center" {{ $attributes }}>
    <i class="{{ $icon }}" style="font-size: {{ $font }}; color: {{ $color }};"></i>
    <h5 class="mt-3"
        style="color: {{ $color }};">{{ $message }}</h5>
    {{ $slot ?? '' }}
</div>
