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
    <div class="flex flex-row items-center justify-center p-1 text-white bg-primary text-xs ">
        {{ $weekDayLabel }} {!! Carbon::create($week[$weekDayLabel])->format('m/d') !!}
    </div>




            @foreach($data as $row)
                @php
//                    dd($row);
                    $title="Click to change status of service for customer:\n $row->cust_name";
                    if ($row->cust_id == 712) {
                        $classes_service = "btnFeeService  disabled ";
                        $wire_click = "\$dispatch('refresh-week')";
                    }else{
                        if ($row->fee === 1) {
                            $classes_service = "text-amber-600 btnFeeService secondary  cursor-pointer ";
                            $wire_click = "\$dispatch('trigger-cancel-fee',{id:$row->service_id})";
                        } else {
                            $confirmClass = $row->confirmed ? 'text-green-700' : 'text-red-700';
                            $classes_service = " btn-confirm-form cursor-pointer " . $confirmClass;
//                            $wire_click = "confirmService($row->service_id)";
                            $wire_click = "\$dispatch('toggle-status-service',{id:$row->service_id})";
                        }
                    }
                @endphp
                @php($c++)
                <div class="flex flex-row items-center  justify-between  p-1 text-gray-600 text-xs border-b">
                    <div>
                        <a
                                id="el-{{$row->service_id}}"
                                class=" {{$classes_service}}  "
                                wire:click="{!! $wire_click !!}"

                                title="{{$title}}"
                                @if($row->cust_id == 712) disabled @endif
                        >
                            @if($row->cust_id == 712)
                                <span class="num-2 text-white"> 08:00 AM </span>
                            @else
                                <span class="num-2 "> {{ Funcs::carbonFormat($row->service_date,'h')}}</span>
                            @endif
                        </a>

                    </div>
                    <div >
                        <a
                                data-service-id="{{$row->service_id}}"
                                class="hover:underline cursor-pointer text-gray-700"
                                wire:click ="populateModal({{$row->service_id}})"
                                @click="open = !open"
                                title="{{$title}}"
                        >
                            {{ Funcs::nameShort($row->cust_name,' ',2) }}
                        </a>


                    </div>
                    <div class="badge text-xs">

                                @if(!empty($row->notes))
                                    <i class="fa-solid fa-message-middle mr-1"></i>
                                    @else
                            <i class="px-1">&nbsp;</i>
                                @endif
                                @if($row->cust_type === 'RENTALHOUSE')
                                    <i class="fa-solid fa-house-day"></i>
                                    @else
                                        <i class="px-1">&nbsp;</i>
                                @endif

                    </div>
                </div>

                <tr class="yellow-row">
                    <td class="valign-wrapper">
                        <div class="left valign-wrapper center-align padding-0 p-l-4 p-r-4">
                        </div>
                        <div class="valign-wrapper left-align padding-0 ">


                        </div>
                        <div title="{{$title}}">

                        </div>
                    </td>
                </tr>
            @endforeach
        @if($c === 1)
            <div class="flex flex-row items-center  justify-center p-1 text-gray-600 text-xs border-b">
                <a class="hover:underline cursor-pointer text-gray-700 link-modal-residential modal-on-livewire " wire:click="$dispatch('select-cad-employee', {empId:'{{$employeeId}}',dateTime:'{{$week[$weekDayLabel]}}'} )" >***OPEN***</a>
            </div>
        @endif
                @if($arrayCount == 0)
                    <div class="flex flex-row items-center  justify-center p-1 text-gray-600 text-xs border-b">
                        <a class="hover:underline cursor-pointer text-gray-700 link-modal-residential modal-on-livewire " wire:click="$dispatch('select-cad-employee', {empId:'{{$employeeId}}',dateTime:'{{$week[$weekDayLabel]}}'} )" >***OPEN***</a>
                    </div>
                    <div class="flex flex-row items-center  justify-center p-1 text-gray-600 text-xs border-b">
                        <a class="hover:underline cursor-pointer text-gray-700 link-modal-residential modal-on-livewire " wire:click="$dispatch('select-cad-employee', {empId:'{{$employeeId}}',dateTime:'{{$week[$weekDayLabel]}}'} )" >***OPEN***</a>
                    </div>

                @endif

@endif
