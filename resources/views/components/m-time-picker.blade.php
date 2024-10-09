
{{--@props(['options' => "{autoClose: true,showClearBtn: true,yearRange: 50,format:'mm/dd/yyyy',}"])--}}
<input
        x-data
        x-init="M.Timepicker.init($refs.input, {} );"
        x-ref="input"
        type="text"
        data-input
        {{ $attributes->merge(['class' => 'form-control']) }}
/>