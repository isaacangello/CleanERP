@php
    //dd($data);
    if(is_null($this->computedService->minus)){ $this->computedService->minus = 0;}
    if(is_null($this->computedService->plus)){ $this->computedService->plus = 0;}
      $total = (float)$this->computedService->price + (float)$this->computedService->plus + -1 *((float)($this->computedService->minus));
//        $this->dispatch('sum-totals', val: $total);
@endphp

<tr class="{{ \App\Helpers\Funcs::altClass($i,['grey lighten-2','']) }} " >
    <td class="p-0 my-0">
        <a
                class="  pointer valign-wrapper w-7 h-7  @if($this->computedService->paid_out)btn btn-link btn-success btn-flat white-text @else btn btn-link btn-flat btn-danger white-text  @endif"
                @if($this->computedService->paid_out) wire:click="confirmPaid('{{$this->computedService->id}}',false)" @else wire:click="confirmPaid('{{$this->computedService->id}}',true)" @endif

        >
            @if($this->computedService->paid_out)
                <span class="material-symbols-outlined relative right-2">
                task_alt
                </span>
            @else
                <span class="material-symbols-outlined relative right-2">
                    error
                </span>
            @endif
        </a>
    </td>
    <td class="center-align font-10 h-7 p-0 my-0" title="{{Carbon\Carbon::create($data->service_date)->format('l, m/d/Y h:i A') }}">{{Carbon\Carbon::create($data->service_date)->format('m/d') }}</td>
    <td class="center-align font-10 p-0 my-0" title="{{$this->title}}">
       <a class="btn-link-underline pointer font-10 @if($this->computedService->fee) text-amber-500 @endif " wire:click.prevent="modalCall"> {{$data->cust_name}}</a>
    </td>
    <td class="font-10 h-7 p-0 my-0">{{$data->frequency}}</td>
    <td class="font-10 flex p-0 my-0">
        <span class="">$</span>
        <select
                class="{{ \App\Helpers\Funcs::altClass($i,['grey lighten-2','']) }}
                w-90   block text-gray-600  bg-white  border-t-0 border-b border-x-0 border-gray-300  shadow-sm h-30  text-left cursor-default
                focus:outline-none focus:ring-0  focus:border-t-0 focus:border-b focus:border-x-0  focus:border-green-800 sm:text-sm font-10"
                wire:change="changePrice"
                wire:model="price"
        >
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

    <td class="font-10 p-0 m-0">$ {{number_format(($total*0.7),2)}}</td>
    <td class="font-10 p-0 m-0">$ {{number_format(($total*0.3),2)}}</td>
    <td class=" font-10 w-24 h-7 p-0 my-0">
        <div class="w-full flex gap-1">
        <div><span class="">$</span></div> <div><x-text-input type="text" class=" font-10 h-30" wire:change="changeValues" wire:model="plus" value="{{$this->computedService->plus}}"/></div>
        </div>
        @error('plus')
            @script
            <script>
                    console.log("error in plus")
                    $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
            </script>
            @endscript
        @enderror
    </td>
    <td class=" font-10 w-24 p-0 my-0">
        <div class="flex gap-1">
        <div><span >$</span></div> <div><x-text-input class=" font-10 h-30" wire:change="changeValues" wire:model="minus" value="{{$this->computedService->minus}}"/></div>
        </div>
        @error('minus')
        @script
            <script>
                    console.log("error in minus")
                    $wire.dispatch('toast-btn-alert',{icon:'error', title:"Error", text:"{{$message}}"})
            </script>
        @endscript
        @enderror

    </td>
    <td class="font-10 p-0 my-0">$ {{number_format($total,2)}}</td>
    <td class="p-0 my-0">
        <select name="" id=""
                class="{{ \App\Helpers\Funcs::altClass($i,['grey lighten-2','']) }}
                   block text-gray-600  bg-white  border-t-0 border-b border-x-0 border-gray-300 h-7  shadow-sm   text-left cursor-default
                focus:outline-none focus:ring-0  focus:border-t-0 focus:border-b focus:border-x-0  focus:border-green-800 sm:text-sm font-10"
                wire:model="payment" wire:change="changePayment"
        >
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
