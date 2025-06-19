
    <div class="container-fluid p-4" >
        <div class="p-4">
            <h2>
                SEARCHES <!--before rebase-->
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="bg-white p-4">
            <div class="">
                <div class="card">
                    <div class="header">
                                <span>
                                  Week Number <span class="yellow-text text-darken-4 font-bold">{{ $numWeek }}</span> / From <span
                                            class="label-date-home">{{ $from }}</span> - Till <span
                                            class="label-date-home">{{ $till }} </span>
                                </span>
                    </div>
                    <div class="body" x-data="searchScreen">
                        <div class="w-full text-sm font-medium text-center flex items-center justify-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                            <ul class="nav nav-tabs tab-col-green flex m-l-2" role="tablist">
                                <li role="presentation"   class="px-5">
                                    <a  class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500"
                                        x-ref="tabServiceElement"
                                        aria-current="page"
                                        data-toggle="tab"
                                        @click="selectTab('tabService')"
                                    >
                                        <i class="fa-duotone fa-solid fa-vacuum"></i>
                                        <span class="uppercase">Services</span>
                                    </a>
                                </li>
                                <li role="presentation"  class="px-5">
                                    <a  class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 cursor-pointer"
                                        data-toggle="tab"
                                        x-ref="tabRepeatElement"
                                        @click="selectTab('tabRepeat')"
                                    >
                                        <i class="fa-duotone fa-regular fa-magnifying-glass-arrows-rotate"></i>
                                        <span class="uppercase">Search Repetition</span>
                                    </a>
                                </li>
                                <li role="presentation"  class="px-5">
                                    <a  class="cursor-pointer inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                        data-toggle="tab"
                                        x-ref="tabCustomerElement"
                                        @click="selectTab('tabCustomer')"
                                    >
                                        <i class="fa-duotone fa-regular fa-user-magnifying-glass"></i>
                                        <span class="uppercase" >Search Customer</span>
                                    </a>
                                </li>
                                <li role="presentation"  class="px-5">
                                    <a  class="cursor-pointer inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                        x-ref="tabEmployeeElement"
                                        data-toggle="tab"
                                        @click="selectTab('tabEmployee')"
                                    >
                                        <i class="fa-backward fa-regular fa-user-magnifying-glass"></i>
                                        <span class="uppercase">Search Employee</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <div role="tabpanel" class="tab-pane fade in active" id="tab_service"
                                 x-show="tabService"
                                 x-trap="tabService"
                                 x-transition:enter="animate__animated animate__fadeIn animate__faster"
                            >
                                <livewire:search-services />
                            </div>
                            <div role="tabpanel" class="tab-pane fade in active" id="TabRepeat"
                                 x-show="tabRepeat"
                                 x-trap="tabRepeat"
                                 x-transition:enter="animate__animated animate__fadeIn animate__faster"
                            >
                                <livewire:search-repeat />
                            </div>
                            <div role="tabpanel" class="tab-pane fade in active" id="tab_customer"
                                 x-show="tabCustomer"
                                 x-trap="tabCustomer"
                                 x-transition:enter="animate__animated animate__fadeIn animate__faster"
                            >
                                <livewire:search-customer :key="$this->formId" @edit-customer="editCustomer($event.detail.id);selectTab('tabCustomer')" />

                                <div x-data="{
                                        showCustomerEdit: $wire.entangle('showCustomerEdit')
                                    }"
                                >
                                    <x-flowbite.customer-html-form :$billings />


                                </div>

                            </div>
                        </div>
                            <div role="tabpanel" class="tab-pane fade in active" id="tab_employee"
                                 x-show="tabEmployee"
                                 x-trap="tabEmployee"
                                 x-transition:enter="animate__animated animate__fadeIn animate__faster"
                            >
                                <livewire:search-employee @edit-employee="editEmployee($event.detail.id);selectTab('tabEmployee')" />
                                <div x-data="{
                                        showEmployeeEdit: $wire.entangle('showEmployeeEdit')
                                    }"
                                >
                                    <x-flowbite.employee-html-form  />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <x-old.search-javascript />--}}
    </div>



