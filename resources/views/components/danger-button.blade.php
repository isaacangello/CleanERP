<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-link red darken-4']) }}>
    {{ $slot }}
</button>
