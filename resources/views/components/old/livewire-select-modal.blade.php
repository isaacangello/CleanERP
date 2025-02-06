<select  {{ $attributes->merge(['class'=>'materialize-select browser-default h-30']) }}>

    <option value="null" @if(is_null($selected) or !isset($selected) ) selected @endif disabled>Options</option>

    @foreach($data as $dataRow)
       @if($selected === $dataRow->id)
                <option value="{{ $dataRow->id }}" selected>{{ $dataRow->name }}</option>
       @else
                <option value="{{ $dataRow->id }}">{{ $dataRow->name }}</option>
       @endif
    @endforeach
</select>
