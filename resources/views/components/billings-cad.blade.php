<div>

    <div id="new-billing" class="modal bottom-sheet">
        <div class="modal-header">
            <h6>Create a new Billings price. </h6>
        </div>
        <div class="modal-content modal-content-bs">
            <div class="container z-depth-3" style="width: 95%">

                <div class="hide info-box-3 bg-red hover-zoom-effect animate__animated animate__shakeX"
                     id="error_infobox">
                    <div class="icon">
                        <i class="material-icons pulse">report</i>
                    </div>
                    <div class="content">
                        <div class="text ">ERROR</div>
                        <div id="error-text" class="number count-to" data-from="0" data-to="125" data-speed="1000"
                             data-fresh-interval="20"></div>
                    </div>
                </div>
                <!-- Divider ######################################################################################################-->
                <div class="row label-employee-view-edit">
                    <span class="label bg--blue-grey  label-padding">People involved in the service schedule</span>
                </div>
                <!-- Divider ######################################################################################################-->
                @php
                @endphp
                <form id="billing-form" wire:submit.prevent="newBilling">
                    @csrf
{{--                    <input type="hidden" name="who_saved"--}}
{{--                           value="{{\App\Helpers\Funcs::replaceSpaces(Auth::user()->name)}}">--}}
{{--                    <input type="hidden" name="who_saved_id" value="{{Auth::user()->id}}">--}}
                    <!-- Row ######################################################################################################-->
                    <div class="row">
                        <div class=" col s12 m6">
                            <div class="form-group">
                                <div class="form-line success form-line-label">
                                    <label class="form-label" for="cad-billings-label">Label</label>
                                    <input type="text" class="form-control @error('form.label')  red lighten-5 @enderror" id="cad-billings-label" wire:model="form.label"/>
                                </div>
                                @error('form.label')
                                <div class="help-info red-text darken-4" id="help-info-denomination">{{ $message }}</div>
                                @enderror
                                <div class="@error('form.label') hide @enderror help-info" id="help-info-denomination">Type label of Billing.</div>
                            </div>
                        </div>
                        <div class=" col s12 m6">
                            <div class="form-group">
                                <div class="form-line success form-line-label">
                                    <label class="form-label" for="cad-billings-label">Value</label>
                                    <input type="text" class="form-control @error('form.value')  red lighten-5 @enderror" id="cad-billings-label" wire:model="form.value"/>
                                </div>
                                @error('form.value')
                                <div class="help-info red-text darken-4" id="help-info-denomination">{{ $message }}</div>
                                @enderror
                                <div class="@error('form.value') hide @enderror help-info" id="help-info-denomination">Type value for billing.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col s12 m12">
                            <label for="cad-billings-hint">Hint.</label>
                            <div class="form-group">
                                <div class="form-line success form-line-hint">
                                    <textarea style="padding: 10px;" id="cad-billings-hint" wire:model="form.hint"
                                              class="form-control custom-textarea @error('form.hint')  red lighten-5 @enderror" rows="4"
                                              placeholder="Please type instructions for employees here..."></textarea>
                                </div>
                                @error('form.hint')
                                <div class="help-info red-text darken-4" id="help-info-denomination">{{ $message }}</div>
                                @enderror
                                <div class="@error('form.hint') hide @enderror  help-info" id="help-info-hint">Type description of billing price.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn  btn-small " type="submit">save changes</button>
                            <a href="" class="btn modal-close  btn-small red darken-4" wire:click.prevent="$wire.dispatch('close-modal')">Cancel</a>
                        </div>
                    </div>
                </form>
            </div><!--END OF CONTAINER -->
        </div><!--END OF MODAL CONTENT -->
    </div>

</div>