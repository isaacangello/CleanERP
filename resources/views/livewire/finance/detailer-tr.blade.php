@php
    //dd($data);
    if(is_null($this->computedService->minus)){ $this->computedService->minus = 0;}
    if(is_null($this->computedService->plus)){ $this->computedService->plus = 0;}
      $total = (float)$this->computedService->price + (float)$this->computedService->plus + -1 *((float)($this->computedService->minus));

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
    <td>
    <span class="valign-wrapper left h-45">$</span>
        <select class="{{ \App\Helpers\Funcs::altClass($i,['grey lighten-2','']) }}  w-90 materialize-select browser-default font-13 " wire:change="changePrice" wire:model="price" >
            @if($this->computedService->price <= 0){
                <option value="0" selected >
                    No Price
                </option>
            @else
                <option value="{{$this->computedService->price}}" selected>
                    {{$this->computedService->price}}
                </option>
            @endif
            @foreach($this->computedPrices as $price)
{{--                @php dd($price); @endphp--}}

                <option  wire:key="pricekey{{$price->id}}" value="{{$price->value}}" @if( $this->computedService->price === $price->value) selected @endif> {{ $price->value }}</option>
            @endforeach
        </select>
        @error('price')
            @script
                <script>
                    console.log("error in price")
                    $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                </script>
            @endscript
        @enderror

    </td>

    <td>$ {{number_format(($total*0.7),2)}}</td>
    <td>$ {{number_format(($total*0.3),2)}}</td>
    <td class="w-100">
        <span class="valign-wrapper left h-45 right-align m-l-2">$</span> <x-text-input class=" font-13 w-50" wire:change="changeValues" wire:model="plus" value="{{$this->computedService->plus}}"/>
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
            <span class="valign-wrapper left h-45">$</span> <x-text-input class=" font-13 w-50" wire:change="changeValues" wire:model="minus" value="{{$this->computedService->minus}}"/>
        @error('minus')
        @script
            <script>
                    console.log("error in minus")
                    $wire.dispatch('toast-btn-alert',{icon:'error', title:"Error", text:"{{$message}}"})
            </script>
        @endscript
        @enderror

    </td>
    <td>$ {{number_format($total,2)}}</td>
    <td>
        <select name="" id="" class="{{ \App\Helpers\Funcs::altClass($i,['grey lighten-2','']) }} materialize-select browser-default font-13" wire:model="payment" wire:change="changePayment">
            @if(is_null($this->computedService->payment) || $this->computedService->payment === 0)
                <option value="0" selected="selected">&nbsp;</option>
                @else
                <option value="{{$this->paymentSelected->id}}" selected="selected">{{$this->paymentSelected->title}}</option>

            @endif


            @foreach($this->computedPayments as $payRow)

                        <option value="{{$payRow->id}}" wire:key="paymentKey{{$payRow->id}}" >{{$payRow->title}}</option>

            @endforeach
        </select>
        @error('payment')
            @script
                <script>
                    console.log("error in payment")
                    $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                </script>
            @endscript
        @enderror


    </td>
</tr>
