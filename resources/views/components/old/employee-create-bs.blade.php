@props(['showEmployeeCreate' => false , 'formType' => "EDIT",  'name' => 'CreateEmployee', ])
<div>
    @php
        if($this->formType === 'CREATE'){
            $formType = 'CREATE';
        }
        elseif($this->formType === 'EDIT'){
            $formType = 'EDIT';
        }
    @endphp
    <div id="edit-fcustomer" class="modal-default bottom-sheet"
{{--         x-init="$watch('showEmployeeCreate', value => {--}}
{{--                if (value) {--}}
{{--                    document.body.classList.add('overflow-y-hidden');--}}
{{--                    {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}--}}
{{--                } else {--}}
{{--                    document.body.classList.remove('overflow-y-hidden');--}}
{{--                }--}}
{{--            })"--}}

         x-on:open-modal.window="$event.detail == '{{ $name }}' ? showEmployeeCreate = true : null"
         x-on:close-modal.window="$event.detail == '{{ $name }}' ? showEmployeeCreate = false : null"
         x-on:close.stop="showEmployeeCreate = false"
         x-on:keydown.escape.window="showEmployeeCreate = false"
         x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
         x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
         style="display: {{ $showEmployeeCreate ? 'block' : 'none' }};"
         x-show="showEmployeeCreate"
         x-transition:enter="animate__animated animate__slideInUp animate__faster"
         x-transition:leave="animate__animated animate__slideOutDown animate__faster"

    >
        <div
                x-show="showEmployeeCreate"
                class="fixed inset-0 transform transition-all"
                x-on:click="showEmployeeCreate = false"
                {{--            x-transition:enter="ease-out duration-300"--}}
                x-transition:enter="animate__animated animate__fadeInUpBig "
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                {{--            x-transition:leave="ease-in duration-200"--}}
                x-transition:leave="animate__animated animate__fadeOutDownBig "
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
        >
            <div class="fixed inset-0 bg-green-700 dark:bg-gray-900 opacity-75"></div>
        </div>


        <div class="modal-content modal-content-bs modal-col-white">
            <div class="container">

                <div class="modal-content">
                    <form

                            @if($formType === 'CREATE')
                                id="customer-form-create" wire:submit.prevent="createEmployee"
                                @keydown.ctrl.s.prevent="$wire.createEmployee()"
                            @else
                                id="customer-form-edit" wire:submit.prevent="updateEmployee({{$this->femployee->id??0}})"
                                @keydown.ctrl.s.prevent="$wire.updateEmployee({{$this->femployee->id??0}})"
                            @endif
                            @if($formType === 'EDIT')
                                id="customer-form-edit" wire:submit.prevent="updateEmployee({{$this->femployee->id??0}})"
                                @keydown.ctrl.s.prevent="$wire.updateEmployee({{$this->femployee->id??0}})"
                            @endif
                    >
                        <div class="container " style="width: 95%">
                            <div class="row">
                                <div class="col s12 text-start ">
                                    <h5 class="m-0 p-0 text-start font-bold relative right-2">
                                        @if($formType === 'CREATE')
                                            New Employee
                                        @endif
                                        @if($formType === 'EDIT')
                                            Edit Employee
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <div class="row label-employee-view-edit">
                                <span class="label label-padding">Personal Information</span>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m8">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-name">Employee Name</label>
                                        <div class="form-line success form-line-name">
                                            <input id="input-edit-employee-name" wire:model="femployee.name" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.name')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.name') hide @enderror">Insert employee name</div>
                                    </div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-phone">Phone</label>
                                        <div class="form-line success form-line-phone">
                                            <input id="input-edit-employee-phone" wire:model="femployee.phone" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.phone')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.phone') hide @enderror">Insert employee phone</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-email">Email</label>
                                        <div class="form-line success form-line-email">
                                            <input id="input-edit-employee-email" wire:model="femployee.email" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.email')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.email') hide @enderror">Insert employee email</div>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-birth">Birth Date</label>
                                        <div class="form-line success form-line-birth">
                                            <x-date-flat-pickr id="input-edit-employee-birth" wire:model="femployee.birth" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.birth')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.birth') hide @enderror">Insert employee birth date</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-address">Address</label>
                                        <div class="form-line success form-line-address">
                                            <input id="input-edit-employee-address" wire:model="femployee.address" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.address')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.address') hide @enderror">Insert employee address</div>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-document">Document</label>
                                        <div class="form-line success form-line-document">
                                            <input id="input-edit-employee-document" wire:model="femployee.document" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.document')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.document') hide @enderror">Insert employee document</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m5">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-username">Username</label>
                                        <div class="form-line success form-line-username">
                                            <input id="input-edit-employee-username" wire:model="femployee.username" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.username')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.username') hide @enderror">Insert employee username</div>
                                    </div>
                                </div>
                                <div class="col s12 m5">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-password">Password</label>
                                        <div class="form-line success form-line-password">
                                            <input id="input-edit-employee-password" wire:model="femployee.password" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.password')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.password') hide @enderror">Insert employee password</div>
                                    </div>
                                </div>
                                <div class="col s12 m2">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-new_user">&nbsp;</label>
                                        <div class="form-line success form-line-new_user h-45  ">
                                            <div class="h-full align-middle">
                                                {{--                                            <input id="input-edit-employee-new_user" wire:model="femployee.new_user" type="checkbox" class="form-control"/>--}}
                                                <label for="md-checkbox-keys" >
                                                    <input type="checkbox" wire:model="femployee.new_user" id="md-checkbox-keys" class="accent-green-800">
                                                    <span>New User?</span>
                                                </label>
                                            </div>

                                        </div>
                                        @error('femployee.new_user')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.new_user') hide @enderror">Is she a new user?</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="select-edit-employee-type">Type</label>
                                        <div class="form-line success form-line-type">
                                            <select id="select-edit-employee-type" wire:model="femployee.type"
                                                    class="block text-gray-600  bg-white  border-t-0 border-b border-x-0 border-gray-300  shadow-sm h-45  text-left cursor-default
                                                    focus:outline-none focus:ring-0  focus:border-t-0 focus:border-b focus:border-x-0  focus:border-green-800 sm:text-sm"
                                            >
                                                <option     value="RESIDENTIAL">RESIDENTIAL</option>
                                                <option     value="COMMERCIAL">COMMERCIAL</option>
                                            </select>
                                        </div>
                                        @error('femployee.type')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.type') hide @enderror">Select employee type</div>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="select-edit-employee-status">Status</label>
                                        <div class="form-line success form-line-status">
                                            <select id="select-edit-employee-status" wire:model="femployee.status"
                                                    class="block text-gray-600  bg-white  border-t-0 border-b border-x-0 border-gray-300  shadow-sm h-45  text-left cursor-default
                                                    focus:outline-none focus:ring-0  focus:border-t-0 focus:border-b focus:border-x-0  focus:border-green-800 sm:text-sm"
                                            >
                                                <option @if(isset($this->femployee->status) and $this->femployee->status === "ACTIVE") selected="selected" @endif value="ACTIVE">ACTIVE</option>
                                                <option @if(isset($this->femployee->status) and $this->femployee->status === "INACTIVE") selected="selected" @endif value="INACTIVE">INACTIVE</option>
                                            </select>
                                        </div>
                                        @error('femployee.status')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.status') hide @enderror">Select employee status</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row label-employee-view-edit">
                                <span class="label label-padding">References</span>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-name_ref_one">Reference Name 1</label>
                                        <div class="form-line success form-line-name_ref_one">
                                            <input id="input-edit-employee-name_ref_one" wire:model="femployee.name_ref_one" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.name_ref_one')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.name_ref_one') hide @enderror">Insert reference name 1</div>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-phone_ref_one">Reference Phone 1</label>
                                        <div class="form-line success form-line-phone_ref_one">
                                            <input id="input-edit-employee-phone_ref_one" wire:model="femployee.phone_ref_one" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.phone_ref_one')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.phone_ref_one') hide @enderror">Insert reference phone 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-name_ref_two">Reference Name 2</label>
                                        <div class="form-line success form-line-name_ref_two">
                                            <input id="input-edit-employee-name_ref_two" wire:model="femployee.name_ref_two" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.name_ref_two')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.name_ref_two') hide @enderror">Insert reference name 2</div>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-employee-phone_ref_two">Reference Phone 2</label>
                                        <div class="form-line success form-line-phone_ref_two">
                                            <input id="input-edit-employee-phone_ref_two" wire:model="femployee.phone_ref_two" type="text" class="form-control"/>
                                        </div>
                                        @error('femployee.phone_ref_two')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.phone_ref_two') hide @enderror">Insert reference phone 2</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row label-employee-view-edit">
                                <span class="label label-padding">Other Information</span>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12">
                                    <div class="form-group">
                                        <label class="form-label" for="textarea-edit-employee-restriction">Restrictions</label>
                                        <div class="form-line success form-line-restriction">
                                            <textarea id="textarea-edit-employee-restriction" wire:model="femployee.restriction" class="form-control custom-textarea" rows="4"></textarea>
                                        </div>
                                        @error('femployee.restriction')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.restriction') hide @enderror">Insert employee restrictions</div>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="form-group">
                                        <label class="form-label" for="textarea-edit-employee-description">Description</label>
                                        <div class="form-line success form-line-description">
                                            <textarea id="textarea-edit-employee-description" wire:model="femployee.description" class="form-control custom-textarea" rows="4"></textarea>
                                        </div>
                                        @error('femployee.description')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('femployee.description') hide @enderror">Insert employee description</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-link btn-small waves-effect waves-green" type="submit">Save Changes</button>
                            <a @click="showEmployeeCreate = false;selectTab('tabEmployee');" class="btn btn-link red darken-4 waves-effect waves-red">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>