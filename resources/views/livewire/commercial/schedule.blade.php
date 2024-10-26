<div class="container-fluid" x-data="{
        open: $wire.entangle('showModal'),
        cadOpen: $wire.entangle('showCadModal')
    }">
    <div class="block-header">
        <h2>
            <small>EMPLOYEES SERVICES</small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                            <span>
                              Week Number <span class="yellow-text text-darken-4 font-bold">{{ $numWeek }}</span> / From <span
                                        class="label-date-home">{{ $from }}</span> - Till <span
                                        class="label-date-home">{{ $till }} </span><div class="displaytest">Iphone</div>
                            </span>
                    <span>
                            </span>
                </div>
                <x-commercial-cad :employees="$selectOptionsEmployees" :customers="$selectOptionsCustomers" :$numWeek :$year>

                </x-commercial-cad>
                <div class="body">
                    <x-btn-week-navigator  :$selectedWeek>
                        <x-standard-btn class="btn-small" @click="cadOpen = true">   New <span class="hide-on-small-and-down">schedule</span>  </x-standard-btn>
                    </x-btn-week-navigator>
                    <x-btn-week-mobile-navigator  :$selectedWeek>
                        <x-standard-btn class="btn-small" @click="cadOpen = true">   New <span class="hide-on-small-and-down">schedule</span>  </x-standard-btn>
                    </x-btn-week-mobile-navigator>
                    <div class="hide-on-small-and-down">
                        <div x-data="{ selectedTab: 'groups' }" class="w-full">
                            <div @keydown.right.prevent="$focus.wrap().next()" @keydown.left.prevent="$focus.wrap().previous()" class="flex gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700" role="tablist" aria-label="tab options">
                                <button @click="selectedTab = 'groups'" :aria-selected="selectedTab === 'groups'" :tabindex="selectedTab === 'groups' ? '0' : '-1'" :class="selectedTab === 'groups' ? 'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' : 'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'" class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab" aria-controls="tabpanelGroups" >
                                    Scale 1
                                </button>
                                <button @click="selectedTab = 'likes'" :aria-selected="selectedTab === 'likes'" :tabindex="selectedTab === 'likes' ? '0' : '-1'" :class="selectedTab === 'likes' ? 'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' : 'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'" class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab" aria-controls="tabpanelLikes" >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-4">
                                        <path d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z" />
                                    </svg>
                                    Likes
                                </button>
                                <button @click="selectedTab = 'comments'" :aria-selected="selectedTab === 'comments'" :tabindex="selectedTab === 'comments' ? '0' : '-1'" :class="selectedTab === 'comments' ? 'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' : 'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'" class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab" aria-controls="tabpanelComments" >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-4">
                                        <path d="M3.505 2.365A41.369 41.369 0 0 1 9 2c1.863 0 3.697.124 5.495.365 1.247.167 2.18 1.108 2.435 2.268a4.45 4.45 0 0 0-.577-.069 43.141 43.141 0 0 0-4.706 0C9.229 4.696 7.5 6.727 7.5 8.998v2.24c0 1.413.67 2.735 1.76 3.562l-2.98 2.98A.75.75 0 0 1 5 17.25v-3.443c-.501-.048-1-.106-1.495-.172C2.033 13.438 1 12.162 1 10.72V5.28c0-1.441 1.033-2.717 2.505-2.914Z" />
                                        <path d="M14 6c-.762 0-1.52.02-2.271.062C10.157 6.148 9 7.472 9 8.998v2.24c0 1.519 1.147 2.839 2.71 2.935.214.013.428.024.642.034.2.009.385.09.518.224l2.35 2.35a.75.75 0 0 0 1.28-.531v-2.07c1.453-.195 2.5-1.463 2.5-2.915V8.998c0-1.526-1.157-2.85-2.729-2.936A41.645 41.645 0 0 0 14 6Z" />
                                    </svg>
                                    Comments
                                </button>
                                <button @click="selectedTab = 'saved'" :aria-selected="selectedTab === 'saved'" :tabindex="selectedTab === 'saved' ? '0' : '-1'" :class="selectedTab === 'saved' ? 'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' : 'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'" class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab" aria-controls="tabpanelSaved" >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-4">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2c-1.716 0-3.408.106-5.07.31C3.806 2.45 3 3.414 3 4.517V17.25a.75.75 0 0 0 1.075.676L10 15.082l5.925 2.844A.75.75 0 0 0 17 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41.403 41.403 0 0 0 10 2Z" />
                                    </svg>
                                    Saved
                                </button>
                            </div>
                            <div class="px-2 py-4 text-neutral-600 dark:text-neutral-300">
                                <div x-show="selectedTab === 'groups'" id="tabpanelGroups" role="tabpanel" aria-label="groups"><b><a href="#" class="underline">Groups</a></b> tab is selected</div>
                                <div x-show="selectedTab === 'likes'" id="tabpanelLikes" role="tabpanel" aria-label="likes"><b><a href="#" class="underline">Likes</a></b> tab is selected</div>
                                <div x-show="selectedTab === 'comments'" id="tabpanelComments" role="tabpanel" aria-label="comments"><b><a href="#" class="underline">Comments</a></b> tab is selected</div>
                                <div x-show="selectedTab === 'saved'" id="tabpanelSaved" role="tabpanel" aria-label="saved"><b><a href="#" class="underline">Saved</a></b> tab is selected</div>
                            </div>
                        </div>

                        <div class="row grid-schedules " id="htmlContent">

                                {!! $this->dataCard() !!}

                        </div> <!--grid system row-->
                    </div>
                    <div class="">
                        <div class="row hide-on-med-and-up" id="htmlContent">

                                {!! $this->dataCard() !!}

                        </div> <!--grid system row-->
                    </div>
                </div> <!--card body-->
            </div> <!--card -->


        </div><!-- col -->
        {{--            {{$this->modalData->id??'vazio'}}--}}
    </div>  <!-- row -->
    <x-modal-alphine   :id="$this->modalData->id??'0'">
        <x-slot:title>
            <span wire:loading.remove> {{$this->modalData->customer->name??'Loading...'}} </span>
            <span wire:loading>Loading...</span>
            @foreach ($errors->all() as $error)
                <span class="red-text text-darken-4">{{ $error }}</span>
            @endforeach
        </x-slot>
        <table  wire:loading style="width: 100%; border-collapse: collapse;  height:40vh; ">
            <tbody>
            <tr>

                <td style="width: 40vw; border-bottom:none!important;">


                    <div  wire:loading.flex  style="margin-left: 22vw; margin-top: 10vh" >

                        <div style="width: 25vw;">
                            <div class="preloader pl-size-xl">
                                <div class="spinner-layer pl-teal">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <p>Please wait...</p>
                        </div>

                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <table wire:loading.remove class="table-modal-services-details ">
            <tr>
                <th colspan="1" class="green">Employee:</th>
                <td colspan="3" >
                    <x-livewire-select-modal
                            wire:model="employee1_id"
                            wire:change="field_change('employee1_id')"
                            id="selectServiceEmployee"
                            class="p-l-0"
                            :data="$selectOptionsEmployees"
                            :selected="$this->modalData->employee->id??''"
                    />
                </td>
            </tr>
            <tr>
                <th colspan="1" class="green h-30 w-20p">Customer:</th>
                <td class="w-30p">
                    <x-livewire-select-modal
                            wire:model="customer_id"
                            wire:change="field_change('customer_id')"
                            class="p-l-0"
                            id="selectServiceCustomer"
                            :data="$selectOptionsCustomers"
                            :selected="$this->modalData->customer->id??''"
                    />
                </td>
                <th class="green h-30">Denomination:</th>
                <td class="w-30p">
                    <x-text-input
                            wire:model.blur="denomination"
                            wire:change="field_change('denomination')"
                            class="p-l-2 h-30 font-12 grey-text text-darken-4"
                            id="denomination"
                    />
                </td>

            </tr>
            <tr>
                <th colspan="1" class="green font-12 h-30">Address:</th>
                <td colspan="3"  >
                    <x-text-input
                            wire:model.blur="address"
                            wire:change="field_change('address')"
                            class="p-l-2 h-30 font-12 grey-text text-darken-4"
                            id="ScheduleAddress"
                            type="text"
                    />
                </td>
            </tr>
            <tr>
                <th colspan="1" class="green h-30">Phone:</th>
                <td  colspan="3"  >
                    <x-text-input
                            wire:model="phone"
                            wire:change.blur="field_change('phone')"
                            class="p-l-2 h-30 font-12 grey-text text-darken-4"
                            id="servicePhone"
                            type="text"
                    />
                </td>
            </tr>
            <tr>
                <th class="green h-30">Date:</th>
                <td colspan="3">
                    <x-date-flat-pickr
                            wire:model.blur="service_date"
                            wire:change="field_change('schedule_date')"
                            id="scheduleDate"
                            class="p-l-2 modal-residential-change h-30 font-12 grey-text text-darken-4"
                    />
                </td>
            </tr>
            <tr>
                <th class="green h-30">In:</th>
                <td>
                    <x-time-flat-pickr

                            wire:model.blur="checkin_datetime"
                            wire:change="field_change('checkin_datetime')"
                            id="scheduleInTime"
                            class="p-l-2 modal-residential-change h-30 font-12 grey-text darken-4"
                    />
                </td>
                <th class="green h-30">Out:</th>
                <td>
                    <x-time-flat-pickr
                            wire:model.blur="checkout_datetime"
                            wire:change="field_change('checkout_datetime')"
                            class="p-l-2 modal-residential-change h-30 font-12 grey-text darken-4"
                            id="scheduleOutTime"
                    />
                </td>
            </tr>

            <tr class="hide"><th colspan="4"  class="green  center-align">Info:</th></tr>
            <tr class="hide">
                <td  colspan="4"   class="p-1">
                            <textarea wire:model.blur="info"
                                      wire:change="field_change('info')"
                                      id="serviceInformation"
                                      class="p-l-2 modal-residential-change" cols="30" rows="10"
                            >

                            </textarea>
                </td>
            </tr>

            <tr><th colspan="4" class="green  center-align">notes:</th></tr>
            <tr>
                <td  colspan="4" class="p-1">
                            <textarea
                                    wire:model.blur="notes"
                                    wire:change="field_change('notes')"
                                    id="scheduleNotes"
                                    class="p-l-2 modal-residential-change"  cols="30" rows="10"
                            >

                            </textarea>
                </td>
            </tr>

            <tr><th colspan="4" class="green  center-align">instructions for employees:</th></tr>
            <tr>
                <td  colspan="4" class="grey-text text-darken-3 p-1">
                            <textarea
                                    wire:model="instructions"
                                    wire:change.blur="field_change('instructions')"
                                    id="scheduleInstructions"
                                    class="modal-residential-change"
                                    cols="30" rows="10">

                            </textarea>
                </td>
            </tr>
        </table>
    <x-slot name="footer">
        <div>
            <button type="button"
                    wire:click="delete"
                    @click="open = false"
                    class=" btn-custom btn-link btn-small red darken-3  z-depth-3"
                    id="btnDeleteSchedule"
            >
                <span class="material-symbols-outlined">
                    delete
                </span>
            </button>
        </div>
        <div>
            <button type="button"  @click="open = false" class=" btn-custom btn-link btn-small green darken-3  z-depth-3" data-dismiss="modal">CLOSE</button>
        </div>
    </x-slot>
    </x-modal-alphine>
    <x-custom-events />


</div>

