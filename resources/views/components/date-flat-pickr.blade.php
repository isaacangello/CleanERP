{{--https://forum.laravel-livewire.com/t/looking-for-a-date-time-picker-for-livewire/3682/6--}}
{{-- https://flatpickr.js.org/options/ --}}
@props(['options' => "
    {
        weekNumbers:true,
        monthSelectorType:'static',
        dateFormat:'Y-m-d',
        altFormat:'F j, Y',
        altInput:true,

    }
    "])

<div wire:ignore>
    <input
            x-data
            x-init="flatpickr($refs.input, {{ $options }} );"
            x-ref="input"
            type="text"
            data-input
            {{ $attributes->merge(['class' => 'form-control grey-text text-darken-4', 'aria-label' => "m/d/Y"]) }}
    />
</div>


