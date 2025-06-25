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
    <div class="flex flex-row items-center justify-center p-1 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-sm shadow-blue-500/50 dark:shadow-sm dark:shadow-blue-800/80 text-xs ">

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
                            $confirmClass = $row->confirmed ? 'text-blue-700' : 'text-red-700';
                            $classes_service = " btn-confirm-form cursor-pointer " . $confirmClass;
                            $wire_click = "confirmService($row->service_id)";
//                                $wire_click = "\$dispatch('toggle-status-service',{id:$row->service_id})";
                        }
                    }
                @endphp
                @php($c++)
                <div class="flex flex-row items-center  justify-between gap-1 p-1 text-gray-600 text-xs border-b">
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
                                <span class="num-2 " wire:loading.remove wire:target="confirmService({{$row->service_id}})"> {{ Funcs::carbonFormat($row->service_date,'h')}}</span>
                                <span class="num-2"
                                      wire:loading wire:target="confirmService({{$row->service_id}})"
                                >
                                    <svg aria-hidden="true" role="status" class="inline w-3 h-3  text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                    </svg>
                                    Loading
                                </span>
                            @endif
                        </a>

                    </div>
                    <div >
                        <a
                                data-service-id="{{$row->service_id}}"
                                class="hover:underline cursor-pointer text-gray-700"
                                wire:click ="populateModal({{$row->service_id}})"
                                @click="showModal()"
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
                <a class="hover:underline cursor-pointer text-gray-700 link-modal-residential modal-on-livewire " @click="cadOpen = !cadOpen" wire:click="$dispatch('select-cad-employee', {empId:'{{$employeeId}}',dateTime:'{{$week[$weekDayLabel]}}'} )" >***OPEN***</a>
            </div>
        @endif
                @if($arrayCount == 0)
                    <div class="flex flex-row items-center  justify-center p-1 text-gray-600 text-xs border-b">
                        <a class="hover:underline cursor-pointer text-gray-700 link-modal-residential modal-on-livewire" @click="cadOpen = !cadOpen" wire:click="$dispatch('select-cad-employee', {empId:'{{$employeeId}}',dateTime:'{{$week[$weekDayLabel]}}'} )" >***OPEN***</a>
                    </div>
                    <div class="flex flex-row items-center  justify-center p-1 text-gray-600 text-xs border-b">
                        <a class="hover:underline cursor-pointer text-gray-700 link-modal-residential modal-on-livewire" @click="cadOpen = !cadOpen" wire:click="$dispatch('select-cad-employee', {empId:'{{$employeeId}}',dateTime:'{{$week[$weekDayLabel]}}'} )" >***OPEN***</a>
                    </div>
                @endif

@endif
