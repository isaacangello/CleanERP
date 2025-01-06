{{--https://forum.laravel-livewire.com/t/looking-for-a-date-time-picker-for-livewire/3682/6--}}
{{-- https://flatpickr.js.org/options/ --}}
{{--
                    onChange: function(selectedDates, dateStr, instance){
                        if (dateStr)
                            instance.close();
                    }

--}}
@props(['options' => "
    {
                    weekNumbers:true,
                    monthSelectorType:'dropdown',
                    enableTime: true,
                    dateFormat: 'Y-m-d H:i',
                    altFormat: 'F j, Y h:i K',
                    altInput: true
    }
    "])

<div wire:ignore>
    <input
            x-data
            x-init="flatpickr($refs.input, {{ $options }} );"
            x-ref="input"
            type="text"
            data-input
            {{ $attributes->merge(['class' => 'form-control text-gray-800', 'aria-label' => "m/d/Y"]) }}
    />
</div>


