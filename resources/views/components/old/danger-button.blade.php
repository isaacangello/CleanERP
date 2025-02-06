<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-link btn-small btn-danger bg-red-800 waves-effect waves-red pointer valign-wrapper w-7 h-7']) }}>
    {{ $slot }}
</button>
