        @php
            use App\Helpers\Funcs;
            use Carbon\Carbon;
            $c=0;
            $arrayCount = sizeof($data);
            $text_print = "";
            if(array_key_exists(0,$data)){
                $text_print =  Funcs::carbonFormat($data[0]->service_date);
            }else{

                $text_print = ' ';
            }
        @endphp

@if($weekDayLabel != 'Sunday')
        <tr><td class="text-uppercase" colspan="1">{{ $weekDayLabel }} {!! $text_print !!} </td></tr>


            @foreach($data as $row)
                @php
//                    dd($row->service_id);
                    $title="Service id: $row->service_id \n customer id: $row->cust_id \n employee1 is: $row->emp_id \n customer: $row->cust_name";
                @endphp
                @php($c++)
                <tr class="yellow-row">
                    <td class="">
                        <div class="left valign-wrapper ">
                        <form action="{{route('confirm',['id' => $row->service_id])}}" method="post">
                            @csrf
                            <input type="hidden" name="confirmed" value="{{ $row->confirmed }}">
                            <input type="hidden" name="id" value="{{ $row->service_id }}">

                        <button class="waves-effect waves-light btn-xm {{$row->confirmed?'green darken-3':'red darken-3'}} padding-0  z-depth-2" type="submit" title="{{$title}}">

                            <span class="white-text">
                                {{ Funcs::carbonFormat($row->service_date,'h')}}
                            </span>
                        </button>
                        </form>
                        </div>
                        <div class="valign-wrapper center-align ">

                            <a href="#largeModal" class="btn-link-underline modal-trigger m-l-5">{{ Funcs::nameShort($row->cust_name,' ',2) }}</a>

                        <span class="badge">
                            <span class="material-symbols-outlined ">mark_unread_chat_alt</span>
                           @if($row->cust_type === 'RENTALHOUSE')
                            <span class="material-symbols-outlined ">brightness_7</span>
                            @endif
                        </span>
                        </div>
                    </td>
                </tr>
            @endforeach
        @switch($c)
            @case(1)
                <tr class="yellow-row"><td>&nbsp;&nbsp;<span class="badge">&nbsp;</span>&nbsp;</td></tr>
                <tr class="yellow-row"><td>&nbsp;&nbsp;<span class="badge">&nbsp;</span>&nbsp;</td></tr>
                @break
            @case(2)
                <tr class="yellow-row"><td>&nbsp;&nbsp;<span class="badge">&nbsp;</span>&nbsp;</td></tr>
                @break
        @endswitch
                @if($arrayCount == 0)
                    <tr class="yellow-row"><td>&nbsp;&nbsp;<span class="badge">&nbsp;</span>&nbsp;</td></tr>
                    <tr class="yellow-row"><td>&nbsp;&nbsp;<span class="badge">&nbsp;</span>&nbsp;</td></tr>
                    <tr class="yellow-row"><td>&nbsp;&nbsp;<span class="badge">&nbsp;</span>&nbsp;</td></tr>
                @endif

@endif
