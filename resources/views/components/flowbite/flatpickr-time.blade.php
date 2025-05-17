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
            {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500', 'aria-label' => "m/d/Y"]) }}
    />
</div>


