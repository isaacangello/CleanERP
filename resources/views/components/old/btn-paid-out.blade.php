<a {{ $attributes->merge(['class' => 'btn-link-underline']) }}>
   @if($paid)
        <span class="material-symbols-outlined">
            task_alt
        </span>
   @else
        <span class="material-symbols-outlined">
            error
        </span>
   @endif
</a>
{{--<span class="material-symbols-outlined">--}}
{{--verified--}}
{{--</span>--}}

