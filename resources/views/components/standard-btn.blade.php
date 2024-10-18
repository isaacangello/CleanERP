<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-link z-depth-3']) }}>
    {{ $slot }}
</button>
