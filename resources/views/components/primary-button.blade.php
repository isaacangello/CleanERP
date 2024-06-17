<button {{ $attributes->merge(['type' => 'submit', 'class' => 'waves-effect waves-light btn btn-small green darken-4']) }}>
    {{ $slot }}
</button>
