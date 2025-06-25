@php
    //dd($data);
    if(is_null($this->computedService->minus)){ $this->computedService->minus = 0;}
    if(is_null($this->computedService->plus)){ $this->computedService->plus = 0;}
      $total = (float)$this->computedService->price + (float)$this->computedService->plus + -1 *((float)($this->computedService->minus));
//        $this->dispatch('sum-totals', val: $total);
@endphp

<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600" >
    <td class="p-0 m-0 text-center">
        <a
                class=" cursor-pointer"
                @if($this->computedService->paid_out) wire:click="confirmPaid('{{$this->computedService->id}}',false)" @else wire:click="confirmPaid('{{$this->computedService->id}}',true)" @endif

        >
            @if($this->computedService->paid_out)
                <i class="fa-duotone fa-solid fa-circle-check " style="color: #1E40AF"></i>
{{--                <i class="fa fa-duotone fa-circle-check "></i>--}}
            @else
                <i class="fa fa-duotone fa-circle-xmark" style="color: #882020"></i>
            @endif
        </a>

    </td>
    <td class="text-center  h-7 p-0 m-0" title="{{Carbon\Carbon::create($this->computedService->service_date)->format('l, m/d/Y h:i A') }}">{{Carbon\Carbon::create($this->computedService->service_date)->format('m/d') }}</td>
    <td class="text-center  p-0 m-0" title="{{$this->title}}">
       <a class="btn-link-underline pointer  @if($this->computedService->fee) text-amber-500 @endif " wire:click.prevent="modalCall"> {{$this->computedService->cust_name}}</a>
    </td>
    <td class="h-7 p-0 m-0 text-center">{{$this->computedService->frequency}}</td>
    <td class=" p-0 m-0">
        <div class=" w-full h-full flex gap-1 justify-center items-center">
            <span class="">$</span>
            <x-flowbite.select
                    class="text-xs p-0 m-0 bg-transparent"
                    style="padding: 0"
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
            </x-flowbite.select>
            @error('price')
                @script
                    <script>
                        console.log("error in price")
                        $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                    </script>
                @endscript
            @enderror
        </div>
    </td>

    <td class=" p-0 m-0 text-center">$ {{number_format(($total*0.7),2)}}</td>
    <td class=" p-0 m-0 text-center">$ {{number_format(($total*0.3),2)}}</td>
    <td class="  w-24  p-0 m-0">
        <div class="w-full h-full flex gap-1 justify-center items-center">
        <div><span class="">$</span></div> <div><x-flowbite.input class="mb-2"  style="padding: 0"  wire:change="changeValues" wire:model="plus" value="{{$this->computedService->plus}}"/></div>

        @error('plus')
            @script
            <script>
                    console.log("error in plus")
                    $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
            </script>
            @endscript
        @enderror
        </div>
    </td>
    <td class="  w-24 p-0 m-0">
        <div class="w-full h-full flex gap-1 justify-center items-center">
            <div><span >$</span></div> <div><x-flowbite.input  class="mb-2" style="padding: 0" wire:change="changeValues" wire:model="minus" value="{{$this->computedService->minus}}"/></div>

            @error('minus')
            @script
                <script>
                        console.log("error in minus")
                        $wire.dispatch('toast-btn-alert',{icon:'error', title:"Error", text:"{{$message}}"})
                </script>
            @endscript
            @enderror
        </div>
    </td>
    <td class=" p-0 m-0 text-center">$ {{number_format($total,2)}}</td>
    <td class="p-0 m-0 text-center">
        <x-flowbite.select
                class="bg-transparent"
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
        </x-flowbite.select>
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
