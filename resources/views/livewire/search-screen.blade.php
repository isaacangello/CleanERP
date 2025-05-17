<div>
    <div class="container-fluid" x-data="
                            {
                                        tabService: $wire.entangle('tabService'),
                                        tabRepeat: $wire.entangle('tabRepeat'),
                                        tabCustomer: $wire.entangle('tabCustomer'),
                                        tabEmployee: $wire.entangle('tabEmployee'),
                                        selectTab(selected) {
                                                switch (selected) {
                                                        case 'tabService':
                                                                this.tabService = true;
                                                                this.tabRepeat = false;
                                                                this.tabCustomer = false;
                                                                this.tabEmployee = false;
                                                                this.$refs.tabServiceElement.classList.add('active', 'success');
                                                                this.$refs.tabRepeatElement.classList.remove('active', 'success');
                                                                this.$refs.tabCustomerElement.classList.remove('active', 'success');
                                                                this.$refs.tabEmployeeElement.classList.remove('active', 'success');
                                                                break;
                                                        case 'tabRepeat':
                                                                this.tabService = false;
                                                                this.tabRepeat = true;
                                                                this.tabCustomer = false;
                                                                this.tabEmployee = false;
                                                                this.$refs.tabServiceElement.classList.remove('active', 'success');
                                                                this.$refs.tabRepeatElement.classList.add('active', 'success');
                                                                this.$refs.tabCustomerElement.classList.remove('active', 'success');
                                                                this.$refs.tabEmployeeElement.classList.remove('active', 'success');
                                                                break;
                                                        case 'tabCustomer':
                                                                this.tabService = false;
                                                                this.tabRepeat = false;
                                                                this.tabCustomer = true;
                                                                this.tabEmployee = false;
                                                                this.$refs.tabServiceElement.classList.remove('active', 'success');
                                                                this.$refs.tabRepeatElement.classList.remove('active', 'success');
                                                                this.$refs.tabCustomerElement.classList.add('active', 'success');
                                                                this.$refs.tabEmployeeElement.classList.remove('active', 'success');
                                                                break;
                                                        case 'tabEmployee':
                                                                this.tabService = false;
                                                                this.tabRepeat = false;
                                                                this.tabCustomer = false;
                                                                this.tabEmployee = true;
                                                                this.$refs.tabServiceElement.classList.remove('active', 'success');
                                                                this.$refs.tabRepeatElement.classList.remove('active', 'success');
                                                                this.$refs.tabCustomerElement.classList.remove('active', 'success');
                                                                this.$refs.tabEmployeeElement.classList.add('active', 'success');
                                                                break;
                                                }
                                        }

                            }
    ">
        <div class="block-header">
            <h2>
                <small>SEARCHES</small>
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
                                            class="label-date-home">{{ $till }} </span>
                                </span>
                    </div>
                    <div class="body">
                        <ul class="nav nav-tabs tab-col-green flex m-l-2" role="tablist">
                            <li role="presentation"  x-ref="tabServiceElement" class="px-5 active success">
                                <a  class="pointer " data-toggle="tab" @click="selectTab('tabService')" >
                                    <span class="text-sm material-symbols-outlined">search</span>
                                    <span class="uppercase">Services</span>
                                </a>
                            </li>
                            <li role="presentation" x-ref="tabRepeatElement" class="px-5">
                                <a  class="pointer" data-toggle="tab" @click="selectTab('tabRepeat')" >
                                    <span class="text-sm material-symbols-outlined">mystery</span>
                                    <span class="uppercase">Search Repetition</span>
                                </a>
                            </li>
                            <li role="presentation" x-ref="tabCustomerElement" class="px-5">
                                <a  class="pointer" data-toggle="tab" @click="selectTab('tabCustomer')">
                                    <span class="text-sm material-symbols-outlined">group_search</span>
                                    <span class="uppercase" >Search Customer</span>
                                </a>
                            </li>
                            <li role="presentation" x-ref="tabEmployeeElement" class="px-5">
                                <a  class="pointer" data-toggle="tab" @click="selectTab('tabEmployee')" >
                                    <span class="text-sm material-symbols-outlined">data_loss_prevention</span>
                                    <span class="uppercase">Search Employee</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
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
                                <livewire:search-customer @edit-customer="editCustomer($event.detail.id);selectTab('tabCustomer')" />

                                <div x-data="{
                                        showCustomerEdit: $wire.entangle('showCustomerEdit')
                                    }"
                                >
{{--                                    <x-customer-edit-bs :$billings />--}}


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
{{--                                    <x-employee-edit-bs  />--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-old.search-javascript />
</div>