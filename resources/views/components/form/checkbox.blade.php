@props(['name' => '', 'label' => str_replace('_', ' ', Str::title($name ?? ''))])

<div class="mb_15">
    <div class="box-checkbox fieldset-radio d-flex align-items-center gap-8">
        <input type="checkbox" {{ $attributes->merge(['class' => 'tf-check']) }} {{ $attributes }}/>
        <label for="" class="text_black-2 fw-4">{{ $label }}</label>
    </div>
</div>
