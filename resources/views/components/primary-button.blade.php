<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn waves-effect waves-classic waves-light  btn-small green darken-4 ']) }}>
    {{ $slot }}
</button>
