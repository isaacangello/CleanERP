        @php
            $c=0;
            $arrayCount = sizeof($data);
        @endphp

        <tr><td colspan="2" class="text-uppercase">{{ $weekDayLabel }}</td></tr>

        <tr>
            @foreach($data as $row)
                @php
//                    dd($row->service_id);
                    $title="Service id: $row->service_id \n customer id: $row->cust_id \n employee1 is: $row->emp_id \n customer: $row->cust_name";
                @endphp

                    <td>
                        <a title="{{$title}}">{{ explode(' ',$row->cust_name)[0] }}</a>

                        <span class="badge">

                            <span class="material-symbols-outlined ">mark_unread_chat_alt</span>
                            <span class="material-symbols-outlined ">brightness_7</span>
                        </span>
                    </td>
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
                    <td>&nbsp;&nbsp;</td>
                @endif
                @if($arrayCount == 0)
                    <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
                @endif
        </tr>

