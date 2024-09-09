<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-link blue darken-4']) }}>
    {{ $slot }}
</button>
