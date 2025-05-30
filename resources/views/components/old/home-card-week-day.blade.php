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
            //dd($weekDayLabel,$empName,$employeeId);
        @endphp

@if($weekDayLabel != 'Sunday')
        <tr><td class="text-uppercase " colspan="1">{{ $weekDayLabel }} {!! Carbon::create($week[$weekDayLabel])->format('m/d') !!} </td></tr>


            @foreach($data as $row)
                @php
//                    dd($row);
                    $title="Click to confirm service for customer:\n $row->cust_name";
                    if ($row->cust_id == 712) {
                        $classes_service = "btnFeeService secondary disabled p-l-2 p-r-2";
                        $wire_click = "\$dispatch('refresh-week')";
                    }else{
                        if ($row->fee === 1) {
                            $classes_service = "btnFeeService amber darken-3";
                            $wire_click = "\$dispatch('trigger-cancel-fee',{id:$row->service_id})";
                        } else {
                            $confirmClass = $row->confirmed ? 'green darken-3' : 'red darken-3';
                            $classes_service = " btn-confirm-form " . $confirmClass;
                            $wire_click = "confirmService($row->service_id)";
                        }
                    }
                @endphp
                @php($c++)
                <tr class="yellow-row">
                    <td class="valign-wrapper">
                        <div class="left valign-wrapper center-align padding-0 p-l-4 p-r-4">
                            <a
                                    class="p-l-4 p-r-4 {{$classes_service}}  btn-link padding-0 z-depth-3 pointer rounded"
                                    wire:click="{!! $wire_click !!}"

                                    title="{{$title}}"
                            @if($row->cust_id == 712) disabled @endif
                            >
                            @if($row->cust_id == 712)
                                <span class="button__text p-l-10 p-r-10"> OPEN </span>
                                @else
                                <span class="button__text"> {{ Funcs::carbonFormat($row->service_date,'h')}}</span>
                            @endif
                            </a>
                        </div>
                        <div class="valign-wrapper left-align padding-0 ">

                            <a
                                    data-service-id="{{$row->service_id}}"
                                    class="btn-link-underline link-modal-residential modal-on-livewire m-l-5 pointer"
                                    wire:click ="populateModal({{$row->service_id}})"
                                    @click="open = !open"
                                    title="{{$title}}"
                            >
                                {{ Funcs::nameShort($row->cust_name,' ',2) }}
                            </a>

                        </div>
                        <div title="{{$title}}">
                            <span class="badge">
                                @if(!empty($row->notes))
                                <span class="material-symbols-outlined ">mark_unread_chat_alt</span>
                                @endif
                               @if($row->cust_type === 'RENTALHOUSE')
                                    <span class="material-symbols-outlined ">brightness_7</span>
                                @endif
                            </span>

                        </div>
                    </td>
                </tr>
            @endforeach
        @if($c === 1)
            <tr class="yellow-row"><td class="flex content-center"><div class="w-full text-center"><a class="btn-link-underline link-modal-residential modal-on-livewire m-l-5 pointer" wire:click="$dispatch('select-cad-employee', {empId:'{{$employeeId}}',dateTime:'{{$week[$weekDayLabel]}}'} )" >***OPEN***</a></div></td></tr>
        @endif
                @if($arrayCount == 0)
                    <tr class="yellow-row"><td class="flex content-center"><div class="w-full text-center"><a class="btn-link-underline link-modal-residential modal-on-livewire m-l-5 pointer" wire:click="$dispatch('select-cad-employee', {empId:'{{$employeeId}}',dateTime:'{{$week[$weekDayLabel]}}'} )" >***OPEN***</a></div></td></tr>
                    <tr class="yellow-row"><td class="flex content-center"><div class="w-full text-center"><a class="btn-link-underline link-modal-residential modal-on-livewire m-l-5 pointer" wire:click="$dispatch('select-cad-employee', {empId:'{{$employeeId}}',dateTime:'{{$week[$weekDayLabel]}}'} )" >***OPEN***</a></div></td></tr>
                @endif

@endif
