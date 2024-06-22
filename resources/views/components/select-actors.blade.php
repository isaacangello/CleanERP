{{--id="{{$elementId}}" name="{{$elementName}}"--}}
<select {{ $attributes }}>
        @if(isset($customers) and $customers )
{{--            @php dd($customers) @endphp--}}
            @foreach($customers as $customerRow)
                <option value="{{ $customerRow->id }}">{{ $customerRow->name }}</option>
            @endforeach
        @endif
        @if(isset($employees) and $employees)
            @foreach($employees as $employeesRow)
                <option value="{{ $employeesRow->id }}">{{ $employeesRow->name }}</option>
            @endforeach
        @endif
</select>
