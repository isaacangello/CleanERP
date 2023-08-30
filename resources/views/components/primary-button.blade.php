<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-sm green darken-4 text-white']) }}>
    {{ $slot }}
</button>
