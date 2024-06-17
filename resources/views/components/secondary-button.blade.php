<button {{ $attributes->merge(['type' => 'button', 'class' => 'waves-effect waves-light btn grey darken-1']) }}>
    {{ $slot }}
</button>
