<select
        {{$attributes->merge([
        'class'=>"w-full py-2.5 font-medium rounded-lg text-sm"
])}}
>
    {{$slot}}
</select>