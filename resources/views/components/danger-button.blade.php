<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-link btn-small btn-danger waves-effect waves-red']) }}>
    {{ $slot }}
</button>
