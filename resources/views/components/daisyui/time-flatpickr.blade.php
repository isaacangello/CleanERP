{{-- https://forum.laravel-livewire.com/t/looking-for-a-date-time-picker-for-livewire/3682/6 --}}
{{-- https://flatpickr.js.org/options/ --}}
@props(['options' => "
        {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i:S' ,
            altFormat:'h:i K',
            altInput:true,

        }
"
])

<div wire:ignore>
    <input
            x-data
            x-init="flatpickr($refs.input, {{ $options }} );"
            x-ref="input"
            type="text"
            data-input
            {{ $attributes->merge(['class' => 'text-gray-600']) }}
    />
</div>


<div>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
</div>