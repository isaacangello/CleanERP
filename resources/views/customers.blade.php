@extends("layouts.main_old")
@section('title')
    <title>Customers - main - JJL System 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')

    @include('layouts.generic_css')

    <style>
        input.form-control {
            margin-bottom: 0 !important;
            border-bottom: none !important;
        }

        textarea.form-control {
            margin-bottom: 0 !important;
            border-bottom: none !important;
        }

        input.select-dropdown {
            margin-bottom: 0 !important;
            border-bottom: none !important;
        }

        .red:hover {
            background-color: #ef9a9a !important;
        }

    </style>
@endsection

@section('content')
    @php
        if (!isset($count )){$count=0;}
        //<!-- função auxiliar para gerar lista com cores alternadas  -->
                function altclass($nun){
                    if ($nun % 2 > 0 ){
                        return "darken-3";
                    }else{
                        return "darken-4";
                    }
                }
    @endphp

    <div class="container-fluid">
        <div class="block-header">
            <h2>
                <small>CUSTOMERS REGISTER AND VIEW</small>
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col s12 m12">
                <div class="card">
                    <div class="header" style="padding-bottom: 0px;">
                        <div class="row">
                            <div class="col s12 m12">
                                {{--                            <button class="btn btn-link waves-effect waves-light  btn-small modal-trigger"  href="#new-customer"  >New Customer</button>--}}
                                <span id="list-of-customer">LIST OF CUSTOMERS {{ strtoupper($type) }}</span>

                                <!-- ############  Blade  component customer-cad ###########################################################################################-->
                                <!-- component register for register new customer-->
                                <x-customer-cad :billings='$billings_all' :$type/>


                            </div>
                        </div>
                    </div>
                    <!-- tratando variáveis do componentes customer-viewedit -->

                    <div class="body">
                        <livewire:registration.customer-registration filter-type="{{ $type }}"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    @include("layouts.generic_js")
    <script src="{{ asset('web/custom/customers/modal_cad.js') }}"></script>
    <script type="module" src="{{ asset('web/custom/field_change.js') }}"></script>
    <script type="module">
        import {select_billings_changes} from "../js/custom/field_change.js";
        // $('#id-customer-billing').multiSelect()
        $('.customer-billing').multiSelect({
            afterSelect: function (values) {
                console.log(this.options.token)
                select_billings_changes(this.options.token, this.options.customerId)
            },
            afterDeselect: function (values) {
                console.log(this.options.token)
                select_billings_changes(this.options.token, this.options.customerId)
            }
        })

    </script>
@endsection

