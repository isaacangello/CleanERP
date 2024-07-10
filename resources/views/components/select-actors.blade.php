{{--id="{{$elementId}}" name="{{$elementName}}"--}}
<select  {{ $attributes }}>
        @if(isset($customers) and $customers )@php($data = $customers)@endif
        @if(isset($employees) and $employees)@php($data = $employees)@endif
            <option value="null" selected="selected" disabled>Options</option>
            @foreach($data as $dataRow)
                <option value="{{ $dataRow->id }}">{{ $dataRow->name }}</option>
            @endforeach
</select>
