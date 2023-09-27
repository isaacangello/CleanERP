<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn red darken-4 waves-effect waves-classic waves-light']) }}>
    {{ $slot }}
</button>
