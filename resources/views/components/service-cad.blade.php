<div>
       <div id="new-service" class="modal bottom-sheet">
        <div class="modal-content">
            <div class="container z-depth-3" style="width: 95%">
                <div class="row">
                            <div class=" col s12 m6">
                                <div class="form-group">
                                    <div class="form-line success">
                                        <select id="select-cad-service-customer-name" name="customerService">
                                            <option selected value="">Select a customer</option>
                                            #@for($i=1;$i<100;$i++)
                                                 <option  value="{{$i}}">Customer {{$i}} </option>
                                            @endfor
                                        </select>

                                    </div>
                                    <div class="help-info">select the customer for service.</div>
                                </div>
                            </div>
                </div>
                        <div class="modal-footer modal-footer-padding">
                            <button class="btn waves-classic waves-light btn-small " type="submit">save changes</button>
                            <a href="#!" class="btn modal-close waves-classic waves-light btn-small red darken-4">Cancel</a>
                        </div>

            </div><!--END OF CONTAINER -->
        </div><!--END OF MODAL CONTENT -->
    </div>

</div>