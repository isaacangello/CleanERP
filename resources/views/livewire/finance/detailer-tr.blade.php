@php
    //dd($data);
    if(is_null($this->computedService->minus)){ $this->computedService->minus = 0;}
    if(is_null($this->computedService->plus)){ $this->computedService->plus = 0;}
      $total = (float)$this->computedService->price + (float)$this->computedService->plus - (float)($this->computedService->minus*(-1));

@endphp

<tr class="{{ \App\Helpers\Funcs::altClass($i,['grey lighten-2','']) }}" >
    <td class=" w-50">
        <a
                class="  pointer valign-wrapper @if($this->computedService->paid_out)btn btn-link btn-success btn-small white-text @else btn btn-link btn-small btn-danger white-text  @endif"
                @if($this->computedService->paid_out) wire:click="confirmPaid('{{$this->computedService->id}}',false)" @else wire:click="confirmPaid('{{$this->computedService->id}}',true)" @endif
        >
            @if($this->computedService->paid_out)
                <span class="material-symbols-outlined font-15">
                task_alt
                </span>
            @else
                <span class="material-symbols-outlined font-15">
                    error
                </span>
            @endif
        </a>
    </td>
    <td class="center-align">
        {{$data->cust_name}}
    </td>
    <td>{{$data->frequency}}</td>
    <td>$ {{number_format($total,2)}}</td>
    <td>$ {{number_format(($total*0.7),2)}}</td>
    <td>$ {{number_format(($total*0.3),2)}}</td>
    <td class="w-100">
        <span class="valign-wrapper left h-45">$</span> <x-text-input class="right font-13 w-90" wire:change="changeValues" wire:model="plus" value="{{$this->computedService->plus}}"/>
        @error('plus')
            @script
            <script>
                    console.log("error in plus")
                    $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
            </script>
            @endscript
        @enderror
    </td>
    <td class="w-100">
            <span class="valign-wrapper left h-45">$</span> <x-text-input class="right font-13 w-90" wire:change="changeValues" wire:model="minus" value="{{$this->computedService->minus}}"/>
        @error('minus')
        @script
            <script>
                    console.log("error in minus")
                    $wire.dispatch('toast-btn-alert',{icon:'error', title:"Error", text:"{{$message}}"})
            </script>
        @endscript
        @enderror

    </td>
    <td><x-text-input /></td>
</tr>
