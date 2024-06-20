@props(['disabled' => false])
@props(['formGroupStyle' => false])
<div class="form-group" {!!    $formGroupStyle ? $formGroupStyle : ''  !!} >
    <div class="form-line success">
        <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control']) !!} >
    </div>
</div>