<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-link grey darken-1 waves-effect waves-grey']) }}>
    {{ $slot }}
</button>
