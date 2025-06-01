@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'red-text text-darken-3']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
