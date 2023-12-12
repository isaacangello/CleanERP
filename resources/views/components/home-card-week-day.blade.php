        @php
            $c=0;
            $arrayCount = sizeof($data);
        @endphp

        <tr><td colspan="2">{{ $weekDayLabel }} tamanho do data >>{{ $arrayCount }}</td></tr>

        <tr>
            @foreach($data as $row)
                @php(extract($row))
                <td><a>{{ $cust_name }}</a></td>
                @php($c++)
                {{-- pulando para linha de baixo quando atinge dois td's --}}
                @if($c == 2)
                    </tr>
                    <tr>
                        @php($c=0)
                @endif
{{--                checando final da table--}}

            @endforeach
                @if(oddCheck($arrayCount))
                    <td>&nbsp;</td>
                @endif
                @if($arrayCount == 0)
                    <td>&nbsp;</td><td>&nbsp;</td>
                @endif
        </tr>

