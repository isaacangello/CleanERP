<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-link btn-small btn-danger bg-red-800 waves-effect waves-red']) }}>
    {{ $slot }}
</button>
