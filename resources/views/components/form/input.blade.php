@props([
    'name' => '',
    'label' => str_replace('_', ' ', Str::title($name ?? '')),
])

<div class="mb_15">
    <div class="tf-field style-1">
        <input class="tf-field-input tf-input" placeholder=" " {{ $attributes }} wire:model="{{ $name }}"
               name="{{ $name }}">
        <label class="tf-field-label fw-4 text_black-2">{{ $label }}</label>
    </div>

    @error($name)
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>


{{--<div class="tf-field style-1 mb_15">--}}
{{--    <input class="tf-field-input tf-input" placeholder="" type="text" id="name" name="first name">--}}
{{--    <label class="tf-field-label fw-4 text_black-2" for="property1">First name</label>--}}
{{--</div>--}}
