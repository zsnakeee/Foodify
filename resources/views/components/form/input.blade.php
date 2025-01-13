@props([
    'name' => '',
    'label' => str_replace('_', ' ', Str::title($name ?? '')),
])

<div class="mb_15">
    <div class="tf-field style-1">
        <input {{ $attributes->merge(['class' => 'tf-field-input tf-input']) }} {{ $attributes }}
               placeholder=" "
               name="{{ $name }}">
        <label class="tf-field-label fw-4 text_black-2">{{ __($label) }}</label>
    </div>

    <?php
    $wireModel = $attributes->get('wire:model');
    $err = $errors->first($name) ?? ($wireModel ? $errors->first($wireModel) : '');
    ?>

    @if(!empty($err))
        <div class="text-danger small">{{ $err }}</div>
    @endif
</div>


{{--<div class="tf-field style-1 mb_15">--}}
{{--    <input class="tf-field-input tf-input" placeholder="" type="text" id="name" name="first name">--}}
{{--    <label class="tf-field-label fw-4 text_black-2" for="property1">First name</label>--}}
{{--</div>--}}
