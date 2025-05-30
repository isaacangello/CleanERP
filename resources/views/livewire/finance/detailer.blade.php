@php
use Carbon\Carbon;
@endphp
<div class="container-fluid"
     x-data="{
        notesOpen: $wire.entangle('notesOpen'),
        open: $wire.entangle('modalOpen')
        }"
>
    <div class="block-header">
        <h2>
            <small>FINANCES</small>
        </h2>
    </div>
    <!-- Basic Examples -->

    <div class="clearfix row">
        <div class="col s12 m12">
            <div class="card">

                <div class="header">
                    <span>
                          Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span
                            class="label-date-home">{{ $from }}</span> - Till <span
                            class="label-date-home">{{ $till }} </span><div class="displaytest">Iphone</div>
                    </span>
                </div>

                <div class="body">
                    <x-layout.week-navigator :$numWeek :$year :$selectedWeek :$selectedYear   />

                    <div class="clearfix row">
                        <div class="col s12">
                            <x-finance-panel-search :employees="$this->allEmployees()" :$from :$till :id="$currentEmployee->id" />
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">

                                    <div class="panel-default pb-2">
                                        <div class="header bg-blue-grey">
                                            <h2>
                                                <span class="text-xl">
                                                          <b>{{ $currentEmployee->name??'' }}</b>
                                                </span>
                                                <small><b>Total <span class="text-amber-300">$ {{number_format($this->sumTotals,2)}}</span></b></small>
                                            </h2>

                                        </div>
                                    </div>




                                <table class="table table-striped highlight">
                                    <thead>
                                    <tr class="green darken-3 white-text">
                                        <th class="center-align text-wrap">Paid</th>
                                        <th class="center-align ">date</th>
                                        <th class="center-align text-wrap">Customer</th>
                                        <th>Frequency</th>
                                        <th>Price</th>
                                        <th>70%</th>
                                        <th>30%</th>
                                        <th>Plus</th>
                                        <th>Minus</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($this->Data->isNotEmpty())
                                        @php
                                            $i=0;
                                        @endphp
                                        {{--                                        {{dd($employees_services)}}--}}
                                        @foreach($this->Data as $key =>  $data)
{{--                                            @php dd($data); @endphp--}}
                                            <livewire:finance.detailer-tr :key="$data->id.$i" :count="$i" :$data @openModal="openAndPopulateModal({{$key}})"  />
                                            @php($i++)
                                        @endforeach
                                    @else

                                        <tr>
                                            <td colspan="5" style="padding: 10px"><p>Services not found in this week</p></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                <div class="mt-5">
                                    <x-standard-btn class="btn btn-success btn-link btn-small h-30" wire:click="notesOpen = ! notesOpen">Type notes</x-standard-btn>

                                    <x-link-btn
                                            href="{{  route('finances.report.export', [ 'id' => $currentEmployee->id, 'from' => Carbon::create($from)->format('Y-m-d'),  'till' => Carbon::create($till)->format('Y-m-d'), 'message'=> $financeNotes??'&nbsp;' ] ) }} "
                                    >
                                        Print Report
                                    </x-link-btn>


                                    <p x-show="notesOpen" x-collapse.duration.500ms class="mt-3 ">
                                            <textarea id="textarea-finance-notes"
                                                      wire:model.live.debounce="financeNotes"
                                                      class="form-control custom-textarea "
                                                      rows="4"
                                                      placeholder="Type notes..."

                                            ></textarea>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>{{--panel--}}

                </div>

            </div>
        </div>
    </div>
    <x-modal>
        <x-slot:title>
            Finance Information.
        </x-slot>
         <div class="w-full  mt-3.5 mb-12">
             <div class="row">
                 <div class=" col s12 m12">
                     <label for="textarea-cad-costumer-instructions">Finance Notes.</label>
                     <div class="form-group">
                         <div class="form-line success form-line-instructions">
                             <textarea style="padding: 10px;"  id="textarea-cad-costumer-instructions" wire:model="financeNotes"  wire:change.debounce="saveFinanceNotes" class="form-control custom-textarea"  rows="2" placeholder="Please type notes here...">
                                 {{$financeNotes??''}}
                             </textarea>
                         </div>
                         <div class="help-info" id="help-info-instructions">type notes here. </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col s12">
                     <label for="textarea-cad-costumer-instructions">Repeat dates</label>
                     <div class="form-group">
                         <div class="form-line success form-line-instructions">
                                {!! $this->modal_dates??'' !!}
                         </div>

                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col s12">
                     <label for="textarea-cad-costumer-instructions">Marked frequency</label>
                     <div class="form-group">
                         <div class="form-line success form-line-instructions">
                             <span class="text-yellow-800">{{$this->modalMarkedFrequency??""}}</span>
                         </div>
                     </div>
                 </div>
             </div>

         </div>

        <x-slot:footer>
            <x-standard-btn class="btn btn-link btn-small" @click="open = !open ">Close</x-standard-btn>
        </x-slot>
    </x-modal>
    @script
    <script>
        console.log(window)
        window.addEventListener('toast-alert', event =>{
            // console.log(event)
            toastAlert.fire({
                icon: event.detail.icon,
                title: event.detail.message
            })
            //console.log(window)
        })
        window.addEventListener('toast-btn-alert', event =>{
            // console.log(event)
            window.Swal.fire({
                icon: event.detail.icon,
                title: event.detail.title,
                text: event.detail.text
            })
            //console.log(window)
        })


    </script>
    @endscript
</div> {{-- end of container fluid --}}
