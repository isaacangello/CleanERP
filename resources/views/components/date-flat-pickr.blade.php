{{--https://forum.laravel-livewire.com/t/looking-for-a-date-time-picker-for-livewire/3682/6--}}
{{-- https://flatpickr.js.org/options/ --}}
@props(['options' => "
    {
                    weekNumbers:true,
                    monthSelectorType:'static',
                    enableTime: true,
                    dateFormat: 'Y-m-d H:i',
                    altFormat: 'F j, Y h:i K',
                    altInput: true,
                    onChange: function(selectedDates, dateStr, instance){
                        if (dateStr)
                            instance.close();
                    }

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


