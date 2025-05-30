<div class="panel panel-default" >
    <div class="panel-heading p-l-15 p-t-2 p-r-2 p-b-2">
        Search
    </div>

    <div class="panel-body " >
        <div class="clearfix row m-b-0">
            <form wire:submit.prevent="searchServices()">
                    <div class="input-field col s12 m4">
                        <div class="form-group">
                            <div class="form-line success">
                                <select id="select-finance-employee" class="form-control browser-default livewire-select font-12 h-30" wire:model="selectedEmployee" >
                                    <option  value="{{$id??'1'}}">This employee</option>

                                    @foreach($employees as $employee)
                                        <option wire:key="empKey{{$employee['id']}}"  value="{{$employee['id']}}" @if($id === $employee['id']) selected @endif >{{ $employee['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('selectedEmployee')
                                    @script
                                        <script>
                                            console.log("error in plus")
                                                $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                                        </script>
                                    @endscript
                                @enderror
                            </div>
                            <div class="help-info">Select employee.</div>
                        </div>
                    </div>
                    <div class="input-field col s12 m3 ">
                        <div class="form-group">
                            <div class="form-line success">
                                @php
                                        $from = Carbon\Carbon::create($this->from)->format("Y-m-d");
                                        $options = "
                                        {
                                            weekNumbers:true,
                                            monthSelectorType:'static',
                                            dateFormat:'Y-m-d',
                                            altFormat:'F j, Y',
                                            altInput:true,
                                            defaultDate:'$from'
                                        }
                                        ";
                                @endphp
                                <x-date-flat-pickr id="input-search-panel-from" options="{!! $options !!}" class="font-12 h-30" wire:model="from" value="{{$this->from}}"   />
                                <label class="form-label" for="input-finance-from">From</label>
                            </div>
                            <div class="help-info">Insert date from.</div>
                        </div>
                    </div>
                    <div class="input-field col s12 m3">
                        <div class="form-group">
                            <div class="form-line success">
                                @php
                                    $till = Carbon\Carbon::create($this->till)->format("Y-m-d");
                                        $options = "
                                        {
                                            weekNumbers:true,
                                            monthSelectorType:'static',
                                            dateFormat:'Y-m-d',
                                            altFormat:'F j, Y',
                                            altInput:true,
                                            defaultDate: '$till'
                                        }
                                        ";
                                @endphp
                                <x-date-flat-pickr id="input-search-panel-till" options="{!! $options !!}"  class="font-12 h-30" wire:model="till" />
                                <label class="form-label" for="input-finance-till">Till</label>
                            </div>
                            <div class="help-info">Insert date till.</div>
                        </div>

                    </div>
                    <div class="input-field col s12 m2 valign-wrapper">
                        <div class="form-group valign-wrapper">
                            <button type="submit" class="btn btn-link btn-small">Search</button>
                        </div>
                    </div>
            </form>
        </div>

    </div>
</div>